<?php

function getClassementGeneralParMatiere($db)
{
    $query = "SELECT 
                m.nummat, 
                m.nommat, 
                et.numetu, 
                CONCAT(et.prenometu, ' ', et.nometu) AS nom_complet, 
                AVG(av.note) AS moyenne,
                RANK() OVER (PARTITION BY m.nummat ORDER BY AVG(av.note) DESC) AS classement
              FROM avoir_note AS av
              INNER JOIN etudiants AS et ON av.numetu = et.numetu
              INNER JOIN epreuves AS ep ON av.numepr = ep.numepr
              INNER JOIN matieres AS m ON ep.matepr = m.nummat
              GROUP BY m.nummat, m.nommat, et.numetu, et.prenometu, et.nometu";

    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer le classement par épreuve d'une matière
function getClassementParEpreuve($db, $nummat)
{
    $query = "SELECT 
                ep.numepr, 
                ep.libepr, 
                et.numetu, 
                CONCAT(et.prenometu, ' ', et.nometu) AS nom_complet, 
                av.note,
                RANK() OVER (PARTITION BY ep.numepr ORDER BY av.note DESC) AS classement
              FROM avoir_note AS av
              INNER JOIN etudiants AS et ON av.numetu = et.numetu
              INNER JOIN epreuves AS ep ON av.numepr = ep.numepr
              WHERE ep.matepr = :nummat
              GROUP BY ep.numepr, ep.libepr, et.numetu, et.prenometu, et.nometu, av.note";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':nummat', $nummat, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$classementsGeneraux = getClassementGeneralParMatiere($db);
$classementsParEpreuve = [];

foreach ($classementsGeneraux as $classement) {
    $nummat = $classement['nummat'];
    $classementsParEpreuve[$nummat] = getClassementParEpreuve($db, $nummat);
}


if (isset($_POST['create'])) {
    header('Location: index.php?element=matieres&action=add');
    exit();
}

if (isset($_POST['list'])) {

    header('Location: index.php?element=matieres&action=list');
    exit();
}



