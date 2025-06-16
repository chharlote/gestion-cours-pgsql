<?php


include dirname(__FILE__) . "/../../class/matiere.class.php";
include dirname(__FILE__) . "/../../class/module.class.php";

$nummat = $_GET['nummat'];
$matiereCarte = new Matiere($db);
$matiereCarte->fetch($nummat);

if (isset($_POST['update'])) {

    $data = $_POST;
    $matiereUpdate = new Matiere($db, $data);

    $matValide = $matiereUpdate->validate();

    if ($matValide) {
        $isUp = $matiereUpdate->update();
    }

    if ($isUp) {
        $_SESSION['mesgs']['confirm'][] = 'Matière ' . $matiereUpdate->nommat . ' mise à jour';
        $matiereCarte->fetch($nummat);
    } else {
        $_SESSION['mesgs']['error'][] = 'Matière ' . $matiereUpdate->nommat . ' n\'a pas pu être mis à jour';
    }

}