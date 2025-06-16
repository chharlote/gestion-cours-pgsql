<?php
include dirname(__FILE__) . "/../../class/enseignant.class.php";

$numenseignant = $_GET['numens'];
$enseignantCarte = new Enseignant($db);
$enseignantCarte->fetch($numenseignant);

if (isset($_POST['update'])) {
    header('Location: index.php?element=enseignants&action=update&numens=' . $numenseignant);
    exit();
}

if (isset($_POST['confirm_delete'])) {

    header('Location: index.php?element=enseignants&action=delete&numens=' . $numenseignant);
    exit();
}

