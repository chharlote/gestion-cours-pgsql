<div class="dtitle w3-container w3-teal">
    Accueil modules
</div>
<div class="col-2">
    <p>Ici vous pouvez gérer, les modules, en créer, les lister, en modifier ou en supprimer.</p>
    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">

        <div class="w3-row-padding" style="display: flex; justify-content: center; align-items: center;">
            <div class="w3-half" style="text-align: center;">

                <input class="w3-btn w3-blue-grey" type="submit" name="create" value="Créer un module"/>
                <input class="w3-btn w3-blue-grey" type="submit" name="list" value="Lister les modules"/>

            </div>
        </div>

    </form>
</div>

<div class="dtitle w3-container w3-teal">
    📚 Classements des Étudiants par Module
</div>

<?php
$modulesDejaAffiches = [];

foreach ($classementsGenerauxModules as $module):
    if (!in_array($module['nummod'], $modulesDejaAffiches)):
        $modulesDejaAffiches[] = $module['nummod'];
        ?>
        <button class="w3-button w3-block w3-teal w3-left-align"
                onclick="toggleTable('classementGeneral_<?= $module['nummod'] ?>')">
            📊 Module : <?= $module['nommod'] ?>
        </button>
        <div id="classementGeneral_<?= $module['nummod'] ?>" class="w3-hide w3-container">
            <table class="w3-table w3-bordered w3-striped">
                <thead>
                <tr class="w3-teal">
                    <th>Classement</th>
                    <th>Etudiant</th>
                    <th>Moyenne</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($classementsGenerauxModules as $c): ?>
                    <?php if ($c['nummod'] === $module['nummod']): ?>
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

        <?php if (!empty($classementsParMatiereModules[$module['nummod']])): ?>
        <?php
        $matieresDejaAffichees = [];
        foreach ($classementsParMatiereModules[$module['nummod']] as $matiere):
            if (!in_array($matiere['nummat'], $matieresDejaAffichees)):
                $matieresDejaAffichees[] = $matiere['nummat'];
                ?>
                <button class="w3-button w3-block w3-blue-grey w3-left-align"
                        onclick="toggleTable('classementMatiere_<?= $matiere['nummat'] ?>')">
                    📋 Matière : <?= $matiere['nommat'] ?> (<?= $module['nommod'] ?>)
                </button>
                <div id="classementMatiere_<?= $matiere['nummat'] ?>" class="w3-hide w3-container">
                    <table class="w3-table w3-bordered w3-striped">
                        <thead>
                        <tr class="w3-blue-grey">
                            <th>Classement</th>
                            <th>Etudiant</th>
                            <th>Moyenne</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($classementsParMatiereModules[$module['nummod']] as $c): ?>
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
