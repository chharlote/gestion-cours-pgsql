<?php
include dirname(__FILE__) . "/../../class/module.class.php";

$nummod = $_GET['nummod'];
$moduleCarte = new Module($db);
$moduleCarte->fetch($nummod);

if (isset($_POST['confirm_delete'])) {

    $data = $_POST;
    $moduleNom = $moduleCarte->nommod;
    $isDelete = $moduleCarte->delete();

    if ($isDelete) {
        $_SESSION['mesgs']['confirm'][] = 'Module ' . $moduleNom . ' supprimé ';
        header('Location: index.php?element=modules&action=list');
        exit();
    } else {
        $_SESSION['mesgs']['error'][] = 'Module ' . $moduleNom . ' n\'a pas pu être supprimé';
    }
}