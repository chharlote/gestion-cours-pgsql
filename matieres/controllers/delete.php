<?php

include dirname(__FILE__) . "/../../class/matiere.class.php";

$nummat = $_GET['nummat'];
$matiereCarte = new Matiere($db);
$matiereCarte->fetch($nummat);

if (isset($_POST['confirm_delete'])) {

    $data = $_POST;

    $matiereNom = $matiereCarte->nommat;

    $isDelete = $matiereCarte->delete();

    if ($isDelete) {
        $_SESSION['mesgs']['confirm'][] = 'Matière ' . $matiereNom . ' supprimée ';
        header('Location: index.php?element=matieres&action=list');
        exit();
    } else {
        $_SESSION['mesgs']['error'][] = 'Matière ' . $matiereNom . ' n\'a pas pu être supprimé';
    }

}