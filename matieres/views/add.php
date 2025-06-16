<div class="dtitle w3-container w3-teal">
    Création d'une nouvelle matière
</div>

<div class="col-2">

    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue" for="nommat"><b>Nom de la matière</b></label>
                    <input type="text" id="nommat" name="nommat"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="coefmod"><b>Coefficient de la matière</b></label>
                    <input type="text" id="coefmat" name="coefmat"/>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="nummod"><b>Modules</b></label>
                    <select class="w3-select w3-border" name="nummod" id="nummod">

                        <?php
                        foreach ($modules as $module) { ?>
                            <option value="<?= $module->nummod ?>"><?= $module->nommod ?></option>
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