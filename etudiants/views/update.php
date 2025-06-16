<div class="dtitle w3-container w3-teal">
    Création d'un nouvel étudiant
</div>

<div class="col-2">

    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue" for="numetu"><b>Numéro étudiant</b></label>
                    <input type="text" id="numetu" name="numetu" value="<?= $etudiantCarte->numetu ?>" readonly/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="prenometu"><b>Prénom</b></label>
                    <input type="text" id="prenometu" name="prenometu" value="<?= $etudiantCarte->prenometu ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="nometu"><b>Nom</b></label>
                    <input type="text" id="nometu" name="nometu" value="<?= $etudiantCarte->nometu ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="adretu"><b>Adresse</b></label>
                    <input type="text" id="adretu" name="adretu" value="<?= $etudiantCarte->adretu ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="viletu"><b>Ville</b></label>
                    <input type="text" id="viletu" name="viletu" value="<?= $etudiantCarte->viletu ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="cpetu"><b>Code Postal</b></label>
                    <input type="text" id="cpetu" name="cpetu" value="<?= $etudiantCarte->cpetu ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="teletu"><b>Numéro de téléphone</b></label>
                    <input type="text" id="teletu" name="teletu" value="<?= $etudiantCarte->teletu ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datentetu"><b>Date d'entrée</b></label>
                    <input class="w3-input w3-border" type="date" id="datentetu" name="datentetu"
                           value="<?= $etudiantCarte->datentetu ?>"/>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="annetu"><b>Année en cours</b></label>
                    <select class="w3-select w3-border" name="annetu" id="annetu">

                        <?php
                        foreach ($annees as $annee) { ?>
                            <option value="<?= $annee ?>" <?= ($annee == $etudiantCarte->annetu) ? 'selected' : '' ?>><?= $annee ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="sexetu"><b>Sexe</b></label>
                    <select class="w3-select w3-border" name="sexetu" id="sexetu">

                        <?php
                        foreach ($sexes as $sexe) { ?>
                            <option value="<?= $sexe ?>" <?= ($sexe == $etudiantCarte->sexetu) ? 'selected' : '' ?>><?= $sexe ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="remetu"><b>Remarque</b></label>
                    <input type="text" id="remetu" name="remetu" value="<?= $etudiantCarte->remetu ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datnaietu"><b>Date de naissance</b></label>
                    <input class="w3-input w3-border" type="date" id="datnaietu"
                           name="datnaietu" value="<?= $etudiantCarte->datnaietu ?>"/><br/>
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
                           name="update" value="Envoyer"/>
                </div>
            </div>
    </form>
</div>