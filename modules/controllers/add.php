<?php
include dirname(__FILE__) . "/../../class/module.class.php";

$moduleCreate = null;

if (isset($_POST['confirm_envoyer'])) {

    $data = $_POST;
    $module = new Module($db, $data);

    $modValide = $module->validate();

    if ($modValide) {
        $moduleCreate = $module->create();
        if ($moduleCreate != null) {
            $_SESSION['mesgs']['confirm'][] = 'Module ' . $moduleCreate->nommod . ' est créé.';
        } else {
            $_SESSION['mesgs']['error'][] = "Le module n'a pas pu être créé.";
        }
    }

}
if (isset($_POST['cancel'])) {
    $_POST = [];
}



