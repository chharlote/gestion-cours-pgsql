<?php

include dirname(__FILE__) . "/../../class/matiere.class.php";
include dirname(__FILE__) . "/../../class/epreuve.class.php";
include dirname(__FILE__) . "/../../class/enseignant.class.php";
include dirname(__FILE__) . "/../../class/etudiant.class.php";


$epreuveCreate = null;
$enseignants = Enseignant::fetchAll($db);
$matieres = Matiere::fetchAll($db);

$etudiant = new Etudiant($db);
$annees = $etudiant->annees;

if (isset($_POST['confirm_envoyer'])) {

    $data = $_POST;
    $epreuve = new Epreuve($db, $data);

    $matValide = $epreuve->validate();

    if ($matValide) {
        $epreuveCreate = $epreuve->create();

        if ($epreuveCreate != null) {
            $_SESSION['mesgs']['confirm'][] = 'Epreuve ' . $epreuveCreate->numepr . ' est créée.';
            header('Location: index.php?element=epreuves&action=card&numepr=' . $epreuveCreate->numepr);
            exit();
        } else {
            $_SESSION['mesgs']['error'][] = "L'épreuve n'a pas pu être créé.";
        }
    }

}

if (isset($_POST['cancel'])) {
    $_POST = [];
}



