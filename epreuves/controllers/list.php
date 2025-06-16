<?php

include dirname(__FILE__) . "/../../class/matiere.class.php";
include dirname(__FILE__) . "/../../class/epreuve.class.php";
include dirname(__FILE__) . "/../../class/enseignant.class.php";

$filters = [];
$matieres = [];
$enseignants = [];


$list_matieres = Matiere::fetchAll($db);


if (isset($_POST['confirm_filter'])) {
    if (!empty($_POST['numepr'])) {
        $filters['numepr'] = $_POST['numepr'];
    }
    if (!empty($_POST['libepr'])) {
        $filters['libepr'] = $_POST['libepr'];
    }

    if (!empty($_POST['nommat'])) {
        echo 'nommat';
        foreach ($matieres as $matiere) {
            if ($matiere->nommat == $_POST['nommat']) {
                $filters['nummat'] = $matiere->nummat;
                break;
            }
        }
    }
    if (!empty($_POST['datepr'])) {
        $filters['datepr'] = $_POST['datepr'];
    }
    if (!empty($_POST['coefepr'])) {
        $filters['coefepr'] = $_POST['coefepr'];
    }
    if (!empty($_POST['annepr'])) {
        $filters['annepr'] = $_POST['annepr'];
    }


}

if (!empty($filters)) {
    $list_epreuves = Epreuve::find($db, $filters);
} else {
    $list_epreuves = Epreuve::fetchAll($db);
}

foreach ($list_epreuves as $epreuve) {
    $matiere = new Matiere($db);
    $matieres[] = $matiere->fetch($epreuve->matepr);
}

foreach ($list_epreuves as $epreuve) {
    $enseignant = new Enseignant($db);
    $enseignants[] = $enseignant->fetch($epreuve->ensepr);
}
