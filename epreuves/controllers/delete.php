<?php

include dirname(__FILE__) . "/../../class/epreuve.class.php";

$numepr = $_GET['numepr'];
$epreuveCarte = new Epreuve($db);
$epreuveCarte->fetch($numepr);

if (isset($_POST['confirm_delete'])) {

    $data = $_POST;

    $epreuveNom = $epreuveCarte->libepr;

    $isDelete = $epreuveCarte->delete();

    if ($isDelete) {
        $_SESSION['mesgs']['confirm'][] = 'Epreuve ' . $epreuveNom . ' supprimée ';
        header('Location: index.php?element=epreuves&action=list');
        exit();
    } else {
        $_SESSION['mesgs']['error'][] = 'Epreuve ' . $epreuveNom . ' n\'a pas pu être supprimé';
    }

}