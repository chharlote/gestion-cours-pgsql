<?php
// Récupération des classements généraux d'un module'
function getClassementGeneralParModule($db)
{
    $query = "SELECT 
                mo.nummod, 
                mo.nommod, 
                et.numetu, 
                CONCAT(et.prenometu, ' ', et.nometu) AS nom_complet, 
                AVG(av.note) AS moyenne,
                RANK() OVER (PARTITION BY mo.nummod ORDER BY AVG(av.note) DESC) AS classement
              FROM avoir_note AS av
              INNER JOIN etudiants AS et ON av.numetu = et.numetu
              INNER JOIN epreuves AS ep ON av.numepr = ep.numepr
              INNER JOIN matieres AS m ON ep.matepr = m.nummat
              INNER JOIN modules AS mo ON m.nummod = mo.nummod
              GROUP BY mo.nummod, mo.nommod, et.numetu, et.prenometu, et.nometu";

    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupération des classements par matière dans un module
function getClassementParMatiere($db, $nummod)
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
              WHERE m.nummod = :nummod
              GROUP BY m.nummat, m.nommat, et.numetu, et.prenometu, et.nometu";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':nummod', $nummod, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$classementsGenerauxModules = getClassementGeneralParModule($db);
$classementsParMatiereModules = [];

foreach ($classementsGenerauxModules as $classement) {
    $nummod = $classement['nummod'];
    $classementsParMatiereModules[$nummod] = getClassementParMatiere($db, $nummod);
}

if (isset($_POST['create'])) {
    header('Location: index.php?element=modules&action=add');
    exit();
}

if (isset($_POST['list'])) {

    header('Location: index.php?element=modules&action=list');
    exit();
}



