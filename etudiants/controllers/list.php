<?php
include dirname(__FILE__) . "/../../class/etudiant.class.php";

$list_etudiant = [];
$filters = [];
$list_etudiant = Etudiant::fetchAll($db);

if (isset($_POST["confirm_filter"])) {

    if (!empty($_POST['numetu'])) {
        $filters['numetu'] = $_POST['numetu'];
    }
    if (!empty($_POST['prenometu'])) {
        $filters['prenometu'] = $_POST['prenometu'];
    }
    if (!empty($_POST['nometu'])) {
        $filters['nometu'] = $_POST['nometu'];
    }
    if (!empty($_POST['adretu'])) {
        $filters['adretu'] = $_POST['adretu'];
    }
    if (!empty($_POST['viletu'])) {
        $filters['viletu'] = $_POST['viletu'];
    }
    if (!empty($_POST['cpetu'])) {
        $filters['cpetu'] = $_POST['cpetu'];
    }
    if (!empty($_POST['teletu'])) {
        $filters['teletu'] = $_POST['teletu'];
    }
    if (!empty($_POST['datentetu'])) {
        $filters['datentetu'] = $_POST['datentetu'];
    }
    if (!empty($_POST['annetu'])) {
        $filters['annetu'] = $_POST['annetu'];
    }
    if (!empty($_POST['remetu'])) {
        $filters['remetu'] = $_POST['remetu'];
    }
    if (!empty($_POST['sexetu'])) {
        $filters['sexetu'] = $_POST['sexetu'];
    }
    if (!empty($_POST['datnaietu'])) {
        $filters['datnaietu'] = $_POST['datnaietu'];
    }


    if (!empty($filters)) {
        $list_etudiant = Etudiant::find($db, $filters);
    } else {
        $list_etudiant = Etudiant::fetchAll($db);
    }
}




