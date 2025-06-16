<?php

include dirname(__FILE__) . "/../../class/etudiant.class.php";


$etu = new Etudiant($db);

$annees = $etu->annees;
$sexes = $etu->sexes;

if (isset($_POST['confirm_envoyer'])) {

    $data = $_POST;
    $etudiant = new Etudiant($db, $data);

    $etuValider = $etudiant->validate();

    if ($etuValider) {
        $etudiant->create();
        if ($etudiant != null) {
            $_SESSION['mesgs']['confirm'][] = 'Etudiant ' . $etudiant->prenometu . ' ' . $etudiant->nometu . ' est créée.';
        } else {
            $_SESSION['mesgs']['error'][] = "L'éudiant n'a pas pu être créé.";
        }
    }

}



