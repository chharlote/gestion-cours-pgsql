<div class="dtitle w3-container w3-teal">
    Filtrage des matières
</div>

<form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="col-2">
        <table class="w3-table w3-bordered w3-striped w3-hoverable">
            <thead>
            <tr class="w3-teal">
                <th scope="col">Numéro de la matière</th>
                <th scope="col">Nom</th>
                <th scope="col">Coefficient</th>
                <th scope="col">Module</th>
            </tr>
            <tr>
                <th><input class="w3-input" type="text" name="nummat" placeholder="-" value="<?= $_POST['nummat'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="nommat" placeholder="-" value="<?= $_POST['nommat'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="coefmat" placeholder="-" value="<?= $_POST['coefmat'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="nommod" placeholder="-" value="<?= $_POST['nommod'] ?>">
                </th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (is_array($list_matieres) && is_array($modules)) {
                $matieres_transformes = array_map(function ($matiere, $module) {
                    ?>
                    <tr>
                        <td>
                            <a class="w3-text-teal"
                               href="index.php?element=matieres&action=card&nummat=<?= $matiere->nummat ?>">
                                <?= $matiere->nummat ?>
                            </a>
                        </td>
                        <td><?= $matiere->nommat ?></td>
                        <td><?= $matiere->coefmat ?></td>
                        <td><?= $module->nommod ?></td>
                    </tr>
                    <?php
                }, $list_matieres, $modules);
            }
            ?>
            </tbody>
        </table>

        <button class="w3-btn w3-blue-grey" type="submit" name="confirm_filter">Filtrer</button>
    </div>
</form>
