<div class="dtitle w3-container w3-teal">
    Filtrage des épreuves
</div>

<form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="col-2">
        <table class="w3-table w3-bordered w3-striped w3-hoverable">
            <thead>
            <tr class="w3-teal">
                <th scope="col">Numéro de l'épreuve</th>
                <th scope="col">Nom</th>
                <th scope="col">Enseignant</th>
                <th scope="col">Matière</th>
                <th scope="col">Date</th>
                <th scope="col">Coefficient</th>
                <th scope="col">Année</th>
            </tr>
            <tr>
                <th><input class="w3-input" type="text" name="numepr" placeholder="-" value="<?= $_POST['numepr'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="libepr" placeholder="-" value="<?= $_POST['libepr'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="nomens" placeholder="-" value="<?= $_POST['nomens'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="nommat" placeholder="-" value="<?= $_POST['nommat'] ?>">
                </th>
                <th><input class="w3-input" type="date" name="datepr" placeholder="-" value="<?= $_POST['datepr'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="coefepr" placeholder="-" value="<?= $_POST['coefepr'] ?>">
                </th>
                <th><input class="w3-input" type="text" name="annepr" placeholder="-" value="<?= $_POST['annepr'] ?>">
                </th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (is_array($list_epreuves)) {
                $matieres_transformes = array_map(function ($epreuve, $enseignant, $matiere) {
                    ?>
                    <tr>
                        <td>
                            <a class="w3-text-teal"
                               href="index.php?element=epreuves&action=card&numepr=<?= $epreuve->numepr ?>">
                                <?= $epreuve->numepr ?>
                            </a>
                        </td>
                        <td><?= $epreuve->libepr ?></td>
                        <td><?= "$enseignant->preens $enseignant->nomens" ?></td>
                        <td><?= $matiere->nommat ?></td>
                        <td><?= $epreuve->datepr ?></td>
                        <td><?= $epreuve->coefepr ?></td>
                        <td><?= $epreuve->annepr ?></td>
                    </tr>
                    <?php
                }, $list_epreuves, $enseignants, $matieres);
            }
            ?>
            </tbody>
        </table>

        <button class="w3-btn w3-blue-grey" type="submit" name="confirm_filter">Filtrer</button>
    </div>
</form>
