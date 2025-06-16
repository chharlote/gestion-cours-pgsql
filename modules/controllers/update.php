<?php
include dirname(__FILE__) . "/../../class/module.class.php";

$nummod = $_GET['nummod'];
$moduleCarte = new Module($db);
$moduleCarte->fetch($nummod);

if (isset($_POST['update'])) {

    $data = $_POST;
    $moduleUpdate = new Module($db, $data);
    $modValide = $moduleUpdate->validate();

    if ($modValide) {
        $isUp = $moduleUpdate->update();
    }

    if ($isUp) {
        $_SESSION['mesgs']['confirm'][] = 'Module ' . $moduleUpdate->nommod . ' mis à jour';
        $moduleCarte->fetch($nummod);

    } else {
        $_SESSION['mesgs']['error'][] = 'Module ' . $moduleUpdate->nommod . ' n\'a pas pu être mis à jour';
    }

}