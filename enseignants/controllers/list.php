<?php

include dirname(__FILE__) . "/../../class/enseignant.class.php";

$filters = [];

if (isset($_POST['confirm_filter'])) {
    if (!empty($_POST['numens'])) {
        $filters['numens'] = $_POST['numens'];
    }
    if (!empty($_POST['preens'])) {
        $filters['preens'] = $_POST['preens'];
    }
    if (!empty($_POST['nomens'])) {
        $filters['nomens'] = $_POST['nomens'];
    }
    if (!empty($_POST['foncens'])) {
        $filters['foncens'] = $_POST['foncens'];
    }
    if (!empty($_POST['adrens'])) {
        $filters['adrens'] = $_POST['adrens'];
    }
    if (!empty($_POST['vilens'])) {
        $filters['vilens'] = $_POST['vilens'];
    }
    if (!empty($_POST['cpens'])) {
        $filters['cpens'] = $_POST['cpens'];
    }
    if (!empty($_POST['telens'])) {
        $filters['telens'] = $_POST['telens'];
    }
    if (!empty($_POST['datnaiens'])) {
        $filters['datnaiens'] = $_POST['datnaiens'];
    }
    if (!empty($_POST['cpens'])) {
        $filters['datembens'] = $_POST['datembens'];
    }
}

if (!empty($filters)) {
    $list_enseignants = Enseignant::find($db, $filters);
} else {
    $list_enseignants = Enseignant::fetchAll($db);
}


