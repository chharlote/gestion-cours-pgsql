<?php
include dirname(__FILE__) . "/../../class/etudiant.class.php";

$numetudiant = $_GET['numetu'];
$etudiantCarte = new Etudiant($db);
$etudiantCarte->fetch($numetudiant);

$annees = $etudiantCarte->annees;
$sexes = $etudiantCarte->sexes;


if (isset($_POST['update'])) {

    $data = $_POST;
    $etudiantUpdate = new Etudiant($db, $data);

    $etuValider = $etudiantUpdate->validate();

    if ($etuValider) {
        $isUp = $etudiantUpdate->update();
    }

    if ($isUp) {
        $_SESSION['mesgs']['confirm'][] = 'Etudiant ' . $numetudiant . ' mis à jour';
        $etudiantCarte->fetch($numetudiant);

    } else {
        $_SESSION['mesgs']['error'][] = 'Etudiant ' . $numetudiant . ' n\'a pas pu être mis à jour';
    }


}