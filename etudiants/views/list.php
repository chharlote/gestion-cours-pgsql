<div class="dtitle w3-container w3-teal">
    Filtrage des étudiants
</div>

<div class="col-2">
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" class="w3-container">
        <table class="w3-table w3-bordered w3-striped w3-hoverable">

            <thead>
            <tr class="w3-teal">
                <th scope="col">Numéro Etudiant</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Ville</th>
                <th scope="col">Code Postal</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Date d'entrée</th>
                <th scope="col">Année en cours</th>
                <th scope="col">Remarque</th>
                <th scope="col">Sexe</th>
                <th scope="col">Date de naissance</th>
                s
            </tr>
            <tr>
                <th><input class="w3-input" type="text" name="numetu" placeholder="-" value="<?= $_POST['numetu'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="prenometu" placeholder="-"
                           value="<?= $_POST['prenometu'] ?>"></th>
                <th><input class="w3-input" type="text" name="nometu" placeholder="-" value="<?= $_POST['nometu'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="adretu" placeholder="-" value="<?= $_POST['adretu'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="viletu" placeholder="-" value="<?= $_POST['viletu'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="cpetu" placeholder="-" value="<?= $_POST['cpetu'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="teletu" placeholder="-" value="<?= $_POST['teletu'] ?>">
                </th>
                <th><input class="w3-input" type="date" name="datentetu" placeholder="-"
                           value="<?= $_POST['datentetu'] ?>"></th>
                <th><input class="w3-input" type="text" name="annetu" placeholder="-" value="<?= $_POST['annetu'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="remetu" placeholder="-" value="<?= $_POST['remetu'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="sexetu" placeholder="-" value="<?= $_POST['sexetu'] ?>">
                </th>
                <th><input class="w3-input" type="date" name="datnaietu" placeholder="-"
                           value="<?= $_POST['datnaietu'] ?>"></th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (is_array($list_etudiant)) {
                $etudiants_transformes = array_map(function ($etudiant) {
                    ?>
                    <tr>
                        <td>
                            <a class="w3-text-teal"
                               href="index.php?element=etudiants&action=card&numetu=<?= $etudiant->numetu; ?>">
                                <?= $etudiant->numetu ?>
                            </a>
                        </td>
                        <td><?= $etudiant->prenometu ?></td>
                        <td><?= $etudiant->nometu ?></td>
                        <td><?= $etudiant->adretu ?></td>
                        <td><?= $etudiant->viletu ?></td>
                        <td><?= $etudiant->cpetu ?></td>
                        <td><?= $etudiant->teletu ?></td>
                        <td><?= $etudiant->datentetu ?></td>
                        <td><?= $etudiant->annetu ?></td>
                        <td><?= $etudiant->remetu ?></td>
                        <td><?= $etudiant->sexetu ?></td>
                        <td><?= $etudiant->datnaietu ?></td>
                    </tr>
                    <?php
                }, $list_etudiant);
            }
            ?>
            </tbody>

        </table>

        <button class="w3-btn w3-blue-grey" type="submit" name="confirm_filter">Filtrer</button>
    </form>
</div>
