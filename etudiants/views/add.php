<div class="dtitle w3-container w3-teal">
    Création d'un nouvel étudiant
</div>

<div class="col-2">

    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue" for="prenometu"><b>Prénom</b></label>
                    <input type="text" id="prenometu" name="prenometu" value="<?= $_POST['prenometu'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="nometu"><b>Nom</b></label>
                    <input type="text" id="nometu" name="nometu" value="<?= $_POST['nometu'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="adretu"><b>Adresse</b></label>
                    <input type="text" id="adretu" name="adretu" value="<?= $_POST['adretu'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="viletu"><b>Ville</b></label>
                    <input type="text" id="viletu" name="viletu" value="<?= $_POST['viletu'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="cpetu"><b>Code Postal</b></label>
                    <input type="text" id="cpetu" name="cpetu" value="<?= $_POST['cpetu'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="teletu"><b>Numéro de téléphone</b></label>
                    <input type="text" id="teletu" name="teletu" value="<?= $_POST['teletu'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datentetu"><b>Date d'entrée</b></label>
                    <input class="w3-input w3-border" type="date" id="datentetu" name="datentetu"
                           value="<?= $_POST['datentetu'] ?>"/>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="annetu"><b>Année en cours</b></label>
                    <select class="w3-select w3-border" name="annetu" id="annetu">

                        <?php
                        foreach ($annees as $annee) { ?>
                            <option value="<?= $annee ?>"><?= $annee ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="sexetu"><b>Sexe</b></label>
                    <select class="w3-select w3-border" name="sexetu" id="sexetu">

                        <?php
                        foreach ($sexes as $sexe) { ?>
                            <option value="<?= $sexe ?>"><?= $sexe ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="remetu"><b>Remarque</b></label>
                    <input type="text" id="remetu" name="remetu" value="<?= $_POST['remetu'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datnaietu"><b>Date de naissance</b></label>
                    <input class="w3-input w3-border" type="date" id="datnaietu"
                           name="datnaietu" value="<?= $_POST['datnaietu'] ?>"/><br/>
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