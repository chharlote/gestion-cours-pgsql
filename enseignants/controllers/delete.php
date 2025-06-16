<?php

include dirname(__FILE__) . "/../../class/enseignant.class.php";

$numenseignant = $_GET['numens'];
$enseignantCarte = new Enseignant($db);
$enseignantCarte->fetch(null, $numenseignant);

if (isset($_POST['confirm_delete'])) {

    $data = $_POST;
    $isDelete = $enseignantCarte->delete();

    if ($isDelete) {
        $_SESSION['mesgs']['confirm'][] = 'Enseignant ' . $numenseignant . ' supprimé';
        header('Location: index.php?element=enseignants&action=list');
        exit();
    } else {
        $_SESSION['mesgs']['error'][] = 'Enseignant ' . $numenseignant . 'n\'a pas pu être supprimé';
    }
}