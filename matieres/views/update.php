<div class="dtitle w3-container w3-teal">
    Fiche Module
</div>
<div class="col-2">

    <form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Numero de la matière</b></label>
                    <input class="w3-input w3-border" type="text" id="nummat" name="nummat"
                           value="<?= $matiereCarte->nummat ?>" readonly>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="firstname"><b>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="nommat" name="nommat"
                           value="<?= $matiereCarte->nommat ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="lastname"><b>Coefficient</b></label>
                    <input class="w3-input w3-border" type="text" id="coefmat" name="coefmat"
                           value="<?= $matiereCarte->coefmat ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="nummod"><b>Modules</b></label>
                    <select class="w3-select w3-border" name="nummod" id="nummod">

                        <?php $modules = Module::fetchAll($db);
                        foreach ($modules as $module) { ?>
                            <option value="<?= $module->nummod ?>" <?= ($module->nummod == $matiereCarte->nummod) ? 'selected' : '' ?>><?= $module->nommod ?></option>
                        <?php } ?>

                    </select>
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
