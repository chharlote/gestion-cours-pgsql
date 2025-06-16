<?php
include dirname(__FILE__) . "/../../class/enseignant.class.php";


$numenseignant = $_GET['numens'];
$enseignantCarte = new Enseignant($db);
$enseignantCarte->fetch($numenseignant);

if (isset($_POST['update'])) {

    $data = $_POST;
    $enseignantUpdate = new Enseignant($db, $data);

    $etuValider = $enseignantUpdate->validate();

    if ($etuValider) {
        $isUp = $enseignantUpdate->update();
    }

    if ($isUp) {
        $_SESSION['mesgs']['confirm'][] = 'Enseignant ' . $numenseignant . ' mis à jour';
        $enseignantCarte->fetch($numenseignant);

    } else {
        $_SESSION['mesgs']['error'][] = 'Enseignant ' . $numenseignant . ' n\'a pas pu être mis à jour';
    }
}