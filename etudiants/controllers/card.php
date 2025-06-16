<?php
include dirname(__FILE__) . "/../../class/etudiant.class.php";

function getClassementEtudiantModules($db, $numetu)
{
    try {
        $query = "SELECT * FROM (
                    SELECT 
                        mod.nummod, 
                        mod.nommod,
                        et.numetu,
                        CONCAT(et.prenometu, ' ', et.nometu) AS nom_complet, 
                        AVG(av.note) AS moyenne,
                        RANK() OVER (PARTITION BY mod.nummod ORDER BY AVG(av.note) DESC) AS classement
                    FROM avoir_note AS av
                    INNER JOIN etudiants AS et ON av.numetu = et.numetu
                    INNER JOIN epreuves AS ep ON av.numepr = ep.numepr
                    INNER JOIN matieres AS m ON ep.matepr = m.nummat
                    INNER JOIN modules AS mod ON m.nummod = mod.nummod
                    GROUP BY mod.nummod, mod.nommod, et.numetu, et.prenometu, et.nometu
                  ) classement_general
                  WHERE numetu = :numetu";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':numetu', $numetu, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
        return [];
    }
}


$numetudiant = $_GET['numetu'];
$etudiantCarte = new Etudiant($db);
$etudiantCarte->fetch($numetudiant);

$classementModules = getClassementEtudiantModules($db, $numetudiant);

if (isset($_POST['update'])) {
    header('Location: index.php?element=etudiants&action=update&numetu=' . $numetudiant);
    exit();
}

if (isset($_POST['confirm_delete'])) {
    header('Location: index.php?element=etudiants&action=delete&numetu=' . $numetudiant);
    exit();
}
?>
