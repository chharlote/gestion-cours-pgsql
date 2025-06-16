<div class="dtitle w3-container w3-teal">
    Fiche enseignant
</div>
<div class="col-2">
    <form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Numero Ensaignant</b></label>
                    <p><?= $enseignantCarte->numens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Prénom</b></label>
                    <p><?= $enseignantCarte->preens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Nom</b></label>
                    <p><?= $enseignantCarte->nomens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Fonction</b></label>
                    <p><?= $enseignantCarte->foncens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Adresse</b></label>
                    <p><?= $enseignantCarte->adrens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Ville</b></label>
                    <p><?= $enseignantCarte->vilens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Code Postal</b></label>
                    <p><?= $enseignantCarte->cpens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Numéro de téléphone</b></label>
                    <p><?= $enseignantCarte->telens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Date de naissance</b></label>
                    <p><?= $enseignantCarte->datnaiens ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Date d'embauche</b></label>
                    <p><?= $enseignantCarte->datembens ?></p>
                </div>
            </div>

        </div>
    </form>
</div>

<div class="w3-row-padding">
    <div class="w3-half">
        <a href="index.php?element=enseignants&action=update&numens=<?= $enseignantCarte->numens; ?>"
           class="w3-btn w3-grey">Modifier</a>
    </div>
    <div class="w3-half">

        <button class="w3-btn w3-red" onclick="document.getElementById('modal_delete').style.display='block'">
            Supprimer
        </button>
    </div>
</div>

<div id="modal_delete" class="modal" style="display:none;">
    <span onclick="document.getElementById('modal_delete').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content"
          action="index.php?element=enseignants&action=delete&numens=<?= $enseignantCarte->numens; ?>"
          method="POST">
        <div class="container">
            <h1>Supprimer l'enseignant</h1>
            <p>L'utilisateur associé sera également supprimé ainsi que les cours où est inscrit cet enseignant.<br/>
                Êtes-vous sûr de vouloir supprimer cet enseignant ?</p>
            <div class="clearfix">
                <button type="button" onclick="document.getElementById('modal_delete').style.display='none'"
                        class="w3-btn">Non
                </button>
                <input type="submit" name="confirm_delete" class="w3-btn w3-red" value="Oui">
            </div>
        </div>
    </form>
</div>
