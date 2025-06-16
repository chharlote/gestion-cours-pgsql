<?php
// Fonction pour récupérer le classement général des étudiants par année
function getClassementGeneralParAnnee($db)
{
    $query = "SELECT 
                et.annetu, 
                et.numetu, 
                CONCAT(et.prenometu, ' ', et.nometu) AS nom_complet, 
                AVG(av.note) AS moyenne,
                RANK() OVER (PARTITION BY et.annetu ORDER BY AVG(av.note) DESC) AS classement
              FROM avoir_note AS av
              INNER JOIN etudiants AS et ON av.numetu = et.numetu
              INNER JOIN epreuves AS ep ON av.numepr = ep.numepr
              INNER JOIN matieres AS m ON ep.matepr = m.nummat
              INNER JOIN modules AS mo ON m.nummod = mo.nummod
              GROUP BY et.annetu, et.numetu, et.prenometu, et.nometu";

    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$classementsGenerauxAnnee = getClassementGeneralParAnnee($db);


if (isset($_POST['create'])) {
    header('Location: index.php?element=etudiants&action=add');
    exit();
}

if (isset($_POST['list'])) {

    header('Location: index.php?element=etudiants&action=list');
    exit();
}
