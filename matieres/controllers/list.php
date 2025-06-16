<?php

include dirname(__FILE__) . "/../../class/matiere.class.php";
include dirname(__FILE__) . "/../../class/module.class.php";


$filters = [];
$modules = [];

$list_matieres = Matiere::fetchAll($db);
foreach ($list_matieres as $matiere) {
    $mod = new Module($db);
    $modules[] = $mod->fetch($matiere->nummod);
}

if (isset($_POST['confirm_filter'])) {
    if (!empty($_POST['nummat'])) {
        $filters['nummat'] = $_POST['nummat'];
    }
    if (!empty($_POST['nommat'])) {
        $filters['nommat'] = $_POST['nommat'];
    }
    if (!empty($_POST['coefmat'])) {
        $filters['coefmat'] = $_POST['coefmat'];
    }
    if (!empty($_POST['nommod'])) {
        foreach ($modules as $mod) {
            if ($mod->nommod == $_POST['nommod']) {
                $filters['nummod'] = $mod->nummod;
                break;
            }
        }
    }

    $list_matieres = Matiere::find($db, $filters);

    $modules = [];
    foreach ($list_matieres as $matiere) {
        $mod = new Module($db);
        $modules[] = $mod->fetch($matiere->nummod);
    }


}
