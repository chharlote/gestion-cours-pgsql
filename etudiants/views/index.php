<div class="dtitle w3-container w3-teal">
    Accueil étudiants
</div>
<div class="col-2">
    <p>Ici vous pouvez gérer, les étudiants, en créer, les lister, en modifier ou en supprimer.</p>
    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">

        <div class="w3-row-padding" style="display: flex; justify-content: center; align-items: center;">
            <div class="w3-half" style="text-align: center;">

                <input class="w3-btn w3-blue-grey" type="submit" name="create" value="Créer un étudiant"/>
                <input class="w3-btn w3-blue-grey" type="submit" name="list" value="Lister les étudiants"/>

            </div>
        </div>

    </form>
</div>

<?php
$anneesDejaAffichees = [];

foreach ($classementsGenerauxAnnee as $classement):
    if (!in_array($classement['annetu'], $anneesDejaAffichees)):
        $anneesDejaAffichees[] = $classement['annetu'];
        ?>
        <button class="w3-button w3-block w3-teal w3-left-align"
                onclick="toggleTable('classementAnnee_<?= $classement['annetu'] ?>')">
            Année : <?= $classement['annetu'] ?>
        </button>
        <div id="classementAnnee_<?= $classement['annetu'] ?>" class="w3-hide w3-container">
            <table class="w3-table w3-bordered w3-striped">
                <thead>
                <tr class="w3-teal">
                    <th>Classement</th>
                    <th>Etudiant</th>
                    <th>Moyenne</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($classementsGenerauxAnnee as $c): ?>
                    <?php if ($c['annetu'] === $classement['annetu']): ?>
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
