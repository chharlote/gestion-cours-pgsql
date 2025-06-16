<?php

include dirname(__FILE__) . "/../../class/module.class.php";

$filters = [];

if (isset($_POST['confirm_filter'])) {
    if (!empty($_POST['nummod'])) {
        $filters['nummod'] = $_POST['nummod'];
    }
    if (!empty($_POST['nommod'])) {
        $filters['nommod'] = $_POST['nommod'];
    }
    if (!empty($_POST['coefmod'])) {
        $filters['coefmod'] = $_POST['coefmod'];
    }
}

if (!empty($filters)) {
    $list_modules = Module::find($db, $filters);
} else {
    $list_modules = Module::fetchAll($db);
}

