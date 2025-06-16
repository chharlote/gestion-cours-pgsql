<?php
include dirname(__FILE__) . "/../../class/matiere.class.php";
include dirname(__FILE__) . "/../../class/epreuve.class.php";
include dirname(__FILE__) . "/../../class/enseignant.class.php";

function getClassementEpreuve($db, $numepr)
{
    try {
        $query = "SELECT 
                    av.numetu, 
                    CONCAT(et.prenometu, ' ', et.nometu) AS nom_complet, 
                    av.note, 
                    RANK() OVER (ORDER BY av.note DESC) AS classement
                  FROM avoir_note AS av
                  INNER JOIN etudiants AS et ON av.numetu = et.numetu
                  WHERE av.numepr = :numepr";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':numepr', $numepr, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
        return [];
    }
}


$numepr = $_GET['numepr'];
$epreuveCarte = new Epreuve($db);
$epreuveCarte->fetch($numepr);
$enseignant = new Enseignant($db);
$enseignant->fetch($epreuveCarte->ensepr);
$matiere = new Matiere($db);
$matiere->fetch($epreuveCarte->matepr);

$classement = getClassementEpreuve($db, $numepr);


if (isset($_POST['update'])) {
    header('Location: index.php?element=epreuves&action=update&numepr=' . $numepr);
    exit();
}

if (isset($_POST['confirm_delete'])) {

    header('Location: index.php?element=epreuves&action=delete&numepr=' . $numepr);
    exit();
}
