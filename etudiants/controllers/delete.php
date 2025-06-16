<?php

include dirname(__FILE__) . "/../../class/etudiant.class.php";

$numetudiant = $_GET['numetu'];
$etudiantCarte = new Etudiant($db);
$etudiantCarte->fetch($numetudiant);

if (isset($_POST['confirm_delete'])) {

    $data = $_POST;

    $isDelete = $etudiantCarte->delete();

    if ($isDelete) {
        $_SESSION['mesgs']['confirm'][] = 'Etudiant ' . $numetudiant . ' supprimé';
        header('Location: index.php?element=etudiants&action=list');
        exit();
    } else {
        $_SESSION['mesgs']['error'][] = 'Etudiant ' . $numetudiant . 'n\'a pas pu être supprimé';
    }

}