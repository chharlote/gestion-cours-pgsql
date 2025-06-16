<div class="dtitle w3-container w3-teal">
    Filtrage des modules
</div>

<form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="col-2">
        <table class="w3-table w3-bordered w3-striped w3-hoverable">
            <thead>
            <tr class="w3-teal">
                <th scope="col">Numéro</th>
                <th scope="col">Nom</th>
                <th scope="col">Coefficient</th>
            </tr>
            <tr>
                <th><input class="w3-input" type="text" name="nummod" placeholder="-" value="<?= $_POST['nummod'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="nommod" placeholder="-" value="<?= $_POST['nommod'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="coefmod" placeholder="-" value="<?= $_POST['coefmod'] ?>">
                </th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (is_array($list_modules)) {
                $modules_transformes = array_map(function ($module) {
                    ?>
                    <tr>
                        <td>
                            <a class="w3-text-teal"
                               href="index.php?element=modules&action=card&nummod=<?= $module->nummod ?>">
                                <?= $module->nummod ?>
                            </a>
                        </td>
                        <td><?= $module->nommod ?></td>
                        <td><?= $module->coefmod ?></td>
                    </tr>
                    <?php
                }, $list_modules);
            }
            ?>
            </tbody>
        </table>

        <button class="w3-btn w3-blue-grey" type="submit" name="confirm_filter">Filtrer</button>
    </div>
</form>
