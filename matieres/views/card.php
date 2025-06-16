<div class="dtitle w3-container w3-teal">
    Fiche Matière
</div>
<div class="col-2">
    <form class="w3-container" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="dcontent">
            <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Numero Module</b></label>
                    <p><?= $matiereCarte->nummat ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Nom</b></label>
                    <p><?= $matiereCarte->nommat ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Coefficient</b></label>
                    <p><?= $matiereCarte->coefmat ?></p>
                </div>
                <div class="w3-half w3-margin-bottom">
                    <label class="w3-text-blue"><b>Module</b></label>
                    <p><?= $module->nommod ?></p>
                </div>
            </div>

        </div>
    </form>
</div>


<div class="w3-row-padding">
    <div class="w3-half">
        <a href="index.php?element=matieres&action=update&nummat=<?= $matiereCarte->nummat; ?>"
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
          action="index.php?element=matieres&action=delete&nummat=<?= $matiereCarte->nummat; ?>"
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
    Classement des étudiants pour cette matière
</div>

<table class="w3-table w3-bordered w3-striped">
    <thead>
    <tr class="w3-teal">
        <th>Classement</th>
        <th>Nom Complet</th>
        <th>Moyenne</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($classement)): ?>
        <?php foreach ($classement as $c): ?>
            <tr>
                <td><?= $c['classement'] ?? '-' ?></td>
                <td><?= $c['nom'] ?></td>
                <td><?= isset($c['moyenne']) ? number_format($c['moyenne'], 2) : '-' ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3" class="w3-center">Aucun classement disponible.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

