<?php
include dirname(__FILE__) . "/../../class/enseignant.class.php";

$ensCreate = Enseignant::class;

if (isset($_POST['confirm_envoyer'])) {

    $data = $_POST;
    $enseignant = new Enseignant($db, $data);

    $ensValider = $enseignant->validate();

    if ($ensValider) {
        $ensCreate = $enseignant->create();

        if ($ensCreate) {
            $_SESSION['mesgs']['confirm'][] = 'Enseignant ' . $ensCreate->numens . ' est créé.';
        } else {
            $_SESSION['mesgs']['error'][] = "L'enseignant n'a pas pu être créé.";
        }

    }
    
}

if (isset($_POST['cancel'])) {
    $_POST = [];
}




