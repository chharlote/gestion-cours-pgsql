<?php

include dirname(__FILE__) . "/../../class/epreuve.class.php";
include dirname(__FILE__) . "/../../class/enseignant.class.php";
include dirname(__FILE__) . "/../../class/matiere.class.php";
include dirname(__FILE__) . "/../../class/etudiant.class.php";

function getEtudiantsByAnnee($db, $annepr, $numepr)
{
    $query = "SELECT e.numetu, CONCAT(e.prenometu, ' ', e.nometu) AS nom_complet, 
                     COALESCE(a.note, NULL) AS note
              FROM etudiants e
              LEFT JOIN avoir_note a 
                     ON e.numetu = a.numetu 
                     AND a.numepr = :numepr
              WHERE e.annetu = :annepr";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':annepr', $annepr, PDO::PARAM_INT);
    $stmt->bindParam(':numepr', $numepr, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$numepr = $_GET['numepr'];

$epreuveCarte = new Epreuve($db);
$epreuveCarte->fetch($numepr);

$matieres = Matiere::fetchAll($db);
$enseignants = Enseignant::fetchAll($db);

$etudiant = new Etudiant($db);
$annees = $etudiant->annees;

$etudiants = getEtudiantsByAnnee($db, $epreuveCarte->annepr, $numepr);

if (isset($_POST['update'])) {
    $data = $_POST;

    if (isset($data['notes']) && is_array($data['notes'])) {
        try {

            foreach ($data['notes'] as $numetu => $note) {
                if (!is_numeric($note)) {
                    continue;
                }

                $note = filter_var($note, FILTER_VALIDATE_INT);
                if ($note === false || $note < 0 || $note > 20) {
                    continue;
                }

                $queryCheck = "SELECT COUNT(*) FROM avoir_note WHERE numetu = :numetu AND numepr = :numepr";
                $stmtCheck = $db->prepare($queryCheck);
                $stmtCheck->bindParam(':numetu', $numetu, PDO::PARAM_INT);
                $stmtCheck->bindParam(':numepr', $data['numepr'], PDO::PARAM_INT);
                $stmtCheck->execute();
                $exists = $stmtCheck->fetchColumn();

                if ($exists) {
//                    $query = "UPDATE avoir_note SET note = :note WHERE numetu = :numetu AND numepr = :numepr";
                    $query = "CALL modif_note(:numetu, :numepr, :note)";
                } else {
//                    $query = "INSERT INTO avoir_note (numetu, numepr, note) VALUES (:numetu, :numepr, :note)";
                    $query = "CALL ajout_note(:numetu, :numepr, :note)";
                }

                $stmt = $db->prepare($query);
                $stmt->bindParam(':note', $note, PDO::PARAM_INT);
                $stmt->bindParam(':numetu', $numetu, PDO::PARAM_INT);
                $stmt->bindParam(':numepr', $data['numepr'], PDO::PARAM_INT);
                $stmt->execute();
            }

            $_SESSION['mesgs']['confirm'][] = 'Les notes des étudiants ont été mises à jour avec succès.';
        } catch (Exception $e) {
            $_SESSION['mesgs']['error'][] = 'Erreur lors de la mise à jour des notes : ' . $e->getMessage();
        }
    } else {
        $_SESSION['mesgs']['error'][] = 'Aucune note à mettre à jour.';
    }


    $epreuveUpdate = new Epreuve($db, $data);
    $epValide = $epreuveUpdate->validate();

    if ($epValide) {
        $isUp = $epreuveUpdate->update();
    }

    if ($isUp) {
        $_SESSION['mesgs']['confirm'][] = 'Epreuve ' . $epreuveUpdate->libepr . ' mise à jour';
        $epreuveCarte->fetch($numepr);
    } else {
        $_SESSION['mesgs']['error'][] = 'Epreuve ' . $epreuveUpdate->libepr . ' n\'a pas pu être mise à jour';
    }
}




