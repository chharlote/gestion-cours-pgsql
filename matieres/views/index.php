<div class="dtitle w3-container w3-teal">
    Accueil Matières
</div>
<div class="col-2">
    <p>Ici vous pouvez gérer, les matières, en créer, les lister, en modifier ou en supprimer.</p>
    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">

        <div class="w3-row-padding" style="display: flex; justify-content: center; align-items: center;">
            <div class="w3-half" style="text-align: center;">

                <input class="w3-btn w3-blue-grey" type="submit" name="create" value="Créer une matière"/>
                <input class="w3-btn w3-blue-grey" type="submit" name="list" value="Lister les matières"/>

            </div>
        </div>

    </form>
</div>

<div class="dtitle w3-container w3-teal">
    📚 Classements des Étudiants par Matière
</div>

<?php
$matieresDejaAffichees = [];

foreach ($classementsGeneraux as $matiere):
    if (!in_array($matiere['nummat'], $matieresDejaAffichees)):
        $matieresDejaAffichees[] = $matiere['nummat'];
        ?>
        <button class="w3-button w3-block w3-teal w3-left-align"
                onclick="toggleTable('classementGeneral_<?= $matiere['nummat'] ?>')">
            📊 Matière : <?= $matiere['nommat'] ?>
        </button>
        <div id="classementGeneral_<?= $matiere['nummat'] ?>" class="w3-hide w3-container">
            <table class="w3-table w3-bordered w3-striped">
                <thead>
                <tr class="w3-teal">
                    <th>Classement</th>
                    <th>Etudiant</th>
                    <th>Moyenne</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($classementsGeneraux as $c): ?>
                    <?php if ($c['nummat'] === $matiere['nummat']): ?>
                        <tr>
                            <td><?= $c['classement'] ?></td>
                            <td><?= $c['nom_complet'] ?></td>
                            <td><?= number_format($c['moyenne'], 2) ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($classementsParEpreuve[$matiere['nummat']])): ?>
        <?php
        $epreuvesDejaAffichees = [];
        foreach ($classementsParEpreuve[$matiere['nummat']] as $epreuve):
            if (!in_array($epreuve['numepr'], $epreuvesDejaAffichees)):
                $epreuvesDejaAffichees[] = $epreuve['numepr'];
                ?>
                <button class="w3-button w3-block w3-blue-grey w3-left-align"
                        onclick="toggleTable('classementEpreuve_<?= $epreuve['numepr'] ?>')">
                    📋 Épreuve : <?= $epreuve['libepr'] ?> (<?= $matiere['nommat'] ?>)
                </button>
                <div id="classementEpreuve_<?= $epreuve['numepr'] ?>" class="w3-hide w3-container">
                    <table class="w3-table w3-bordered w3-striped">
                        <thead>
                        <tr class="w3-blue-grey">
                            <th>Classement</th>
                            <th>Etudiant</th>
                            <th>Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($classementsParEpreuve[$matiere['nummat']] as $c): ?>
                            <?php if ($c['numepr'] === $epreuve['numepr']): ?>
                                <tr>
                                    <td><?= $c['classement'] ?></td>
                                    <td><?= $c['nom_complet'] ?></td>
                                    <td><?= number_format($c['note'], 2) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            endif;
        endforeach;
        ?>
    <?php endif; ?>

    <?php
    endif;
endforeach;
?>

<script>
    function toggleTable(id) {
        var x = document.getElementById(id);
        if (x.classList.contains("w3-hide")) {
            x.classList.remove("w3-hide");
        } else {
            x.classList.add("w3-hide");
        }
    }
</script>
