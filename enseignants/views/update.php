<div class="dtitle w3-container w3-teal">
    Mise à jour enseignant
</div>
<div class="col-2">

    <form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Numero Enseignant</b></label>
                    <input class="w3-input w3-border" type="text" id="numens" name="numens"
                           value="<?= $enseignantCarte->numens ?>" readonly>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="preens"><b>Prénom</b></label>
                    <input class="w3-input w3-border" type="text" id="preens" name="preens"
                           value="<?= $enseignantCarte->preens ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="nomens"><b>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="nomens" name="nomens"
                           value="<?= $enseignantCarte->nomens ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="foncens"><b>Fonction</b></label>
                    <select class="w3-select w3-border" name="foncens" id="foncens">
                        <option value="<?= $enseignantCarte->foncens ?>"><?= $enseignantCarte->foncens ?></option>
                        <option value="AGREGE">AGREGE</option>
                        <option value="CERTIFIE">CERTIFIE</option>
                        <option value="MAITRE DE CONFERENCES">MAITRE DE CONFERENCES</option>
                        <option value="VACATAIRE">VACATAIRE</option>
                    </select>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="datnaiens"><b>Date d'anniversaire (aaaa-mm-dd)</b></label>
                    <input class="w3-input w3-border" type="date" id="datnaiens" name="datnaiens"
                           value="<?= $enseignantCarte->datnaiens ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="adrens"><b>Adresse</b></label>
                    <input class="w3-input w3-border" type="text" id="adrens" name="adrens"
                           value="<?= $enseignantCarte->adrens ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="cpens"><b>Code Postal</b></label>
                    <input class="w3-input w3-border" type="text" id="cpens" name="cpens"
                           value="<?= $enseignantCarte->cpens ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="vilens"><b>Ville</b></label>
                    <input class="w3-input w3-border" type="text" id="vilens" name="vilens"
                           value="<?= $enseignantCarte->vilens ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="telens"><b>Numéro de téléphone</b></label>
                    <input class="w3-input w3-border" type="text" id="telens" name="telens"
                           value="<?= $enseignantCarte->telens ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="datembens"><b>Date d'embauche</b></label>
                    <input class="w3-input w3-border" type="text" id="datembens" name="datembens"
                           value="<?= $enseignantCarte->datembens ?>">
                </div>
            </div>

            <div class="w3-row-padding w3-margin-top">
                <div class="w3-half">
                    <input class="w3-btn w3-blue-grey w3-block" type="submit" name="update" value="Mettre à jour">
                </div>
            </div>
        </div>
    </form>

</div>
