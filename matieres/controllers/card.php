<?php
include dirname(__FILE__) . "/../../class/matiere.class.php";
include dirname(__FILE__) . "/../../class/module.class.php";

function getClassementMatiere($db, $nummat)
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
                  WHERE ep.matepr = :nummat
                  GROUP BY av.numetu, et.prenometu, et.nometu";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':nummat', $nummat, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
        return [];
    }
}


$nummat = $_GET['nummat'];
$matiereCarte = new Matiere($db);
$matiereCarte->fetch($nummat);
$module = new Module($db);
$module->fetch($matiereCarte->nummod);

$classement = getClassementMatiere($db, $nummat);

if (isset($_POST['update'])) {
    header('Location: index.php?element=matieres&action=update&nummat=' . $nummat);
    exit();
}

if (isset($_POST['confirm_delete'])) {

    header('Location: index.php?element=matieres&action=delete&nummat=' . $nummat);
    exit();
}

