<div class="dtitle w3-container w3-teal">
    Mise à jour des notes des étudiants pour l'épreuve
</div>

<form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="dcontent">
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-blue" for="numepr"><b>Numéro de l'épreuve</b></label>
                <input type="text" id="numepr" name="numepr" value="<?= $epreuveCarte->numepr ?>" readonly/>
            </div>
            <div class="w3-half">
                <label class="w3-text-blue" for="libepr"><b>Nom de l'épreuve</b></label>
                <input type="text" id="libepr" name="libepr" value="<?= $epreuveCarte->libepr ?>" readonly/>
            </div>

            <div class="w3-half w3-margin-bottom">
                <label class="w3-text-blue" for="coefepr"><b>Coefficient</b></label>
                <input type="text" id="coefepr" name="coefepr" value="<?= $epreuveCarte->coefepr ?>" readonly/>
            </div>

            <div class="w3-half w3-margin-bottom">
                <label class="w3-text-blue" for="annepr"><b>Année</b></label>
                <input type="text" id="annepr" name="annepr" value="<?= $epreuveCarte->annepr ?>" readonly/>
            </div>

        </div>

        <div class="w3-half">
            <label class="w3-text-blue" for="ensepr"><b>Enseignant</b></label>
            <select class="w3-select w3-border" name="ensepr" id="ensepr">

                <?php
                foreach ($enseignants as $enseignant) { ?>
                    <option value="<?= $enseignant->numens ?>"><?= "$enseignant->preens $enseignant->nomens" ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="w3-half w3-margin-bottom">
            <label class="w3-text-blue" for="matepr"><b>Matière</b></label>
            <select class="w3-select w3-border" name="matepr" id="matepr">

                <?php
                foreach ($matieres as $matiere) { ?>
                    <option value="<?= $matiere->nummat ?>" <?= ($matiere->nummat == $epreuveCarte->nummat) ? 'selected' : '' ?>><?= $matiere->nommat ?></option>

                <?php } ?>

            </select>
        </div>
        <div class="w3-half">
            <label class="w3-text-blue" for="datepr"><b>Date de l'épreuve</b></label>
            <input class="w3-input w3-border" type="date" id="datepr"
                   name="datepr" value="<?= $epreuveCarte->datepr ?>"/><br/>
        </div>


        <br/>
        <div class="w3-half w3-margin-bottom">
            <label class="w3-text-blue"><b>Notes des étudiants</b></label>
            <table class="w3-table w3-bordered">
                <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($etudiants) > 0): ?>
                    <?php foreach ($etudiants as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nom_complet'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <!-- Si la note est NULL, afficher un champ vide -->
                                <input type="number" name="notes[<?= $row['numetu'] ?>]"
                                       value="<?= isset($row['note']) ? htmlspecialchars($row['note'], ENT_QUOTES, 'UTF-8') : '' ?>"
                                       min="0" max="20"/>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Aucun étudiant n'a été trouvé pour cette année.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="w3-row-padding w3-margin-top">
            <div class="w3-half">
                <input class="w3-btn w3-blue-grey w3-block" type="submit" name="update"
                       value="Mettre à jour"/>
            </div>
        </div>
    </div>
</form>
