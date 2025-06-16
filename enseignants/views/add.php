<div class="dtitle w3-container w3-teal">
    Création d'un nouvel enseignant
</div>

<div class="col-2">

    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue" for="firstname"><b>Prénom</b></label>
                    <input type="text" id="preens" name="preens" value="<?= $_POST['preens'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="lastname"><b>Nom</b></label>
                    <input type="text" id="nomens" name="nomens" value="<?= $_POST['nomens'] ?>"/>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue" for="foncens"><b>Fonction</b></label>
                    <select class="w3-select w3-border" name="foncens" id="foncens">
                        <option value="">-</option>
                        <option value="AGREGE">AGREGE</option>
                        <option value="CERTIFIE">CERTIFIE</option>
                        <option value="MAITRE DE CONFERENCES">MAITRE DE CONFERENCES</option>
                        <option value="VACATAIRE">VACATAIRE</option>
                    </select>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="adrens"><b>Adresse</b></label>
                    <input type="text" id="adrens" name="adrens" value="<?= $_POST['adrens'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="vilens"><b>Ville</b></label>
                    <input type="text" id="vilens" name="vilens" value="<?= $_POST['vilens'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="cpens"><b>Code Postal</b></label>
                    <input type="text" id="cpens" name="cpens" value="<?= $_POST['cpens'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="telens"><b>Numéro de téléphone</b></label>
                    <input type="text" id="telens" name="telens" value="<?= $_POST['telens'] ?>"/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datnaiens"><b>Date de naissance</b></label>
                    <input class="w3-input w3-border" type="date" id="datnaiens"
                           name="datnaiens" value="<?= $_POST['datnaiens'] ?>"/><br/>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datembens"><b>Date d'embauche</b></label>
                    <input class="w3-input w3-border" type="date" id="datembens"
                           name="datembens" value="<?= $_POST['datembens'] ?>"/><br/>
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