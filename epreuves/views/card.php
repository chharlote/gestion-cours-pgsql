<div class="dtitle w3-container w3-teal">
    Fiche Epreuve
</div>
<div class="col-2">
    <form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Numero de l'épreuve</b></label>
                    <p><?= $epreuveCarte->numepr ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Nom de l'épreuve</b></label>
                    <p><?= $epreuveCarte->libepr ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Enseignant</b></label>
                    <p><?= "$enseignant->preens $enseignant->nomens" ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Matière</b></label>
                    <p><?= $matiere->nommat ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Date</b></label>
                    <p><?= $epreuveCarte->datepr ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Coefficient</b></label>
                    <p><?= $epreuveCarte->coefepr ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Année d'étude</b></label>
                    <p><?= $epreuveCarte->annepr ?></p>
                </div>
            </div>

        </div>
    </form>
</div>


<div class="w3-row-padding">
    <div class="w3-half">
        <a href="index.php?element=epreuves&action=update&numepr=<?= $epreuveCarte->numepr; ?>"
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
          action="index.php?element=epreuves&action=delete&numepr=<?= $epreuveCarte->numepr; ?>"
          method="POST">
        <div class="container">
            <h1>Supprimer la matière</h1>
            Les cours associés à cette matière seront supprimés. <br>
            Êtes-vous sûr de vouloir supprimer cette matière ? ?</p>
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
    Classement des étudiants
</div>

<table class="w3-table w3-bordered w3-striped">
    <thead>
    <tr class="w3-teal">
        <th>Classement</th>
        <th>Etudiant</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($classement)): ?>
        <?php foreach ($classement as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['classement']) ?></td>
                <td><?= htmlspecialchars($row['nom_complet']) ?></td>
                <td><?= htmlspecialchars($row['note']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3" class="w3-center">Aucun étudiant classé pour cette épreuve.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

