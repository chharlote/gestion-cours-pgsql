<?php
include dirname(__FILE__) . "/../../class/module.class.php";

function getClassementModule($db, $nummod)
{
    try {
        $query = "SELECT 
                    av.numetu, 
                    CONCAT(et.prenometu, ' ', et.nometu) AS nom, 
                    AVG(av.note) AS moyenne, 
                    RANK() OVER (ORDER BY AVG(av.note) DESC) AS classement
                  FROM avoir_note AS av
                  INNER JOIN etudiants AS et ON av.numetu = et.numetu
                  INNER JOIN epreuves AS ep ON av.numepr = ep.numepr
                  INNER JOIN matieres AS m ON ep.matepr = m.nummat
                  WHERE m.nummod = :nummod
                  GROUP BY av.numetu, et.prenometu, et.nometu";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':nummod', $nummod, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
        return [];
    }
}


$nummod = $_GET['nummod'];
$moduleCarte = new Module($db);
$moduleCarte->fetch($nummod);
$classement = getClassementModule($db, $nummod);

if (isset($_POST['update'])) {
    header('Location: index.php?element=modules&action=update&nummod=' . $nummod);
    exit();
}

if (isset($_POST['confirm_delete'])) {
    header('Location: index.php?element=modules&action=delete&nummod=' . $nummod);
    exit();
}

