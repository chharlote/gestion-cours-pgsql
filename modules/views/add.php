<div class="dtitle w3-container w3-teal">
    Création d'un nouveau module
</div>

<div class="col-2">

    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue" for="nommod"><b>Nom du module</b></label>
                    <input type="text" id="nommod" name="nommod"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="coefmod"><b>Coefficient du module</b></label>
                    <input type="text" id="coefmod" name="coefmod"/>
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