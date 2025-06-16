<div class="dtitle w3-container w3-teal">
    Filtrage des enseignants
</div>

<form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="col-2">
        <table class="w3-table w3-bordered w3-striped w3-hoverable">
            <thead>
            <tr class="w3-teal">
                <th scope="col">Numéro Enseignant</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Fonction</th>
                <th scope="col">Adresse</th>
                <th scope="col">Code Postal</th>
                <th scope="col">Ville</th>
                <th scope="col">Numéro de téléphone</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Date d'embauche</th>
            </tr>
            <tr>
                <th><input class="w3-input" type="text" name="numens" placeholder="-" value="<?= $_POST['numens'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="preens" placeholder="-" value="<?= $_POST['preens'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="nomens" placeholder="-" value="<?= $_POST['nomens'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="foncens" placeholder="-" value="<?= $_POST['foncens'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="adrens" placeholder="-" value="<?= $_POST['adrens'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="cpens" placeholder="-" value="<?= $_POST['cpens'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="vilens" placeholder="-" value="<?= $_POST['vilens'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="telens" placeholder="-" value="<?= $_POST['telens'] ?>">
                </th>
                <th><input class="w3-input" type="date" name="datnaiens" placeholder="-"
                           value="<?= $_POST['datnaiens'] ?>"></th>
                <th><input class="w3-input" type="date" name="datembens" placeholder="-"
                           value="<?= $_POST['datembens'] ?>"></th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (is_array($list_enseignants)) {
                $enseignants_transformes = array_map(function ($enseignant) {
                    ?>
                    <tr>
                        <td>
                            <a class="w3-text-teal"
                               href="index.php?element=enseignants&action=card&numens=<?= $enseignant->numens; ?>">
                                <?= $enseignant->numens ?>
                            </a>
                        </td>
                        <td><?= $enseignant->preens ?></td>
                        <td><?= $enseignant->nomens ?></td>
                        <td><?= $enseignant->foncens ?></td>
                        <td><?= $enseignant->adrens ?></td>
                        <td><?= $enseignant->cpens ?></td>
                        <td><?= $enseignant->vilens ?></td>
                        <td><?= $enseignant->telens ?></td>
                        <td><?= $enseignant->datnaiens ?></td>
                        <td><?= $enseignant->datembens ?></td>
                    </tr>
                    <?php
                }, $list_enseignants);
            }
            ?>
            </tbody>
        </table>

        <button class="w3-btn w3-blue-grey" type="submit" name="confirm_filter">Filtrer</button>
    </div>
</form>
