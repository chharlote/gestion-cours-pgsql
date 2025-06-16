<div class="dtitle w3-container w3-teal">
    Fiche Module
</div>
<div class="col-2">

    <form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Numero du module</b></label>
                    <input class="w3-input w3-border" type="text" id="nummod" name="nummod"
                           value="<?= $moduleCarte->nummod ?>" readonly>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="firstname"><b>Nom</b></label>
                    <input class="w3-input w3-border" type="text" id="nommod" name="nommod"
                           value="<?= $moduleCarte->nommod ?>">
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="lastname"><b>Coefficient</b></label>
                    <input class="w3-input w3-border" type="text" id="coefmod" name="coefmod"
                           value="<?= $moduleCarte->coefmod ?>">
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
