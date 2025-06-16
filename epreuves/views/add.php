<div class="dtitle w3-container w3-teal">
    Création d'une nouvelle épreuve
</div>

<div class="col-2">

    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue" for="libepr"><b>Nom de l'épreuve</b></label>
                    <input type="text" id="libepr" name="libepr" value="<?= $_POST['libepr'] ?>"/>
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
                            <option value="<?= $matiere->nummat ?>"><?= $matiere->nommat ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datepr"><b>Date de l'épreuve</b></label>
                    <input class="w3-input w3-border" type="date" id="datepr"
                           name="datepr" value="<?= $_POST['datepr'] ?>"/><br/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="coefepr"><b>Coefficient</b></label>
                    <input type="text" id="coefepr" name="coefepr" value="<?= $_POST['coefepr'] ?>"/>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="annepr"><b>Année</b></label>
                    <select class="w3-select w3-border" name="annepr" id="annepr">
                        <?php
                        foreach ($annees as $annee) { ?>
                            <option value="<?= $annee ?>"><?= $annee ?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>

            <br/>
            <div class="w3-row-padding">
                <div class="w3-half">
                    <input class="w3-btn w3-red" type="submit" name="cancel"
                           value="Annuler"/>
                </div>
                <div class="w3-half">
                    <input class="w3-btn w3-blue-grey" type="submit"
                           name="confirm_envoyer" value="Envoyer"/>
                </div>
            </div>
    </form>
</div>