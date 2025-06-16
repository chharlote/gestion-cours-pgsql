<div class="dtitle w3-container w3-teal">
    Fiche étudiant
</div>

<div class="col-2">

    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue" for="numetu"><b>Numero Etudiant</b></label>
                    <p><?= $etudiantCarte->numetu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="prenometu"><b>Prénom</b></label>
                    <p><?= $etudiantCarte->prenometu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="nometu"><b>Nom</b></label>
                    <p><?= $etudiantCarte->nometu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="adretu"><b>Adresse</b></label>
                    <p><?= $etudiantCarte->adretu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="viletu"><b>Ville</b></label>
                    <p><?= $etudiantCarte->viletu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="cpetu"><b>Code Postal</b></label>
                    <p><?= $etudiantCarte->cpetu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="teletu"><b>Numéro de téléphone</b></label>
                    <p><?= $etudiantCarte->teletu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datentetu"><b>Date d'entrée</b></label>
                    <p><?= $etudiantCarte->datentetu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="annetu"><b>Année en cours</b></label>
                    <p><?= $etudiantCarte->annetu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="sexetu"><b>Sexe</b></label>
                    <p><?= $etudiantCarte->sexetu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="remetu"><b>Remarque</b></label>
                    <p><?= $etudiantCarte->remetu ?></p>

                </div>
                <div class="w3-half">
                    <label class="w3-text-blue" for="datnaietu"><b>Date de naissance</b></label>
                    <p><?= $etudiantCarte->datnaietu ?></p>

                </div>
            </div>

    </form>
</div>
<div class="w3-row-padding">
    <div class="w3-half">
        <a href="index.php?element=etudiants&action=update&numetu=<?= $etudiantCarte->numetu; ?>"
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
    <form class="modal-content" action="index.php?element=etudiants&action=delete&numetu=<?= $etudiantCarte->numetu; ?>"
          method="POST">
        <div class="container">
            <h1>Supprimer l'étudiant</h1>
            <p>L'utilisateur associé sera également supprimé.<br/>
                Êtes-vous sûr de vouloir supprimer cet étudiant ?</p>
            <div class="clearfix">
                <button type="button" onclick="document.getElementById('modal_delete').style.display='none'"
                        class="w3-btn">Non
                </button>
                <input type="submit" name="confirm_delete" class="w3-btn w3-red" value="Oui">
            </div>
        </div>
    </form>
</div>

<div class="dtitle w3-container w3-teal">
    Classement de l'étudiant dans chaque module
</div>

<table class="w3-table w3-bordered w3-striped">
    <thead>
    <tr class="w3-teal">
        <th>Module</th>
        <th>Classement</th>
        <th>Moyenne</th>
    </tr>
    </thead>
    <tbody>
    <?php

    if (!empty($classementModules)): ?>
        <?php foreach ($classementModules as $module): ?>
            <tr>
                <td><?= $module['nommod'] ?></td>
                <td><?= $module['classement'] ?></td>
                <td><?= number_format($module['moyenne'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3" class="w3-center">Aucun classement disponible pour cet étudiant.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
