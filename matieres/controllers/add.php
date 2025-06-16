<?php

include dirname(__FILE__) . "/../../class/matiere.class.php";
include dirname(__FILE__) . "/../../class/module.class.php";

$matiereCreate = null;
$modules = Module::fetchAll($db);

if (isset($_POST['confirm_envoyer'])) {

    $data = $_POST;
    $matiere = new Matiere($db, $data);

    $matValide = $matiere->validate();

    if ($matValide) {
        $matiereCreate = $matiere->create();

        if ($matiereCreate != null) {
            $_SESSION['mesgs']['confirm'][] = 'Matiere ' . $matiereCreate->nommat . ' est créée.';
        } else {
            $_SESSION['mesgs']['error'][] = "La matière n'a pas pu être créé.";
        }
    }


}

if (isset($_POST['cancel'])) {
    $_POST = [];
}



