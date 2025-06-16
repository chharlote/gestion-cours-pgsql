<div class="dtitle w3-container w3-teal">
    Accueil enseignants
</div>
<div class="col-2">
    <p>Ici vous pouvez gérer, les enseignants, en créer, les lister, en modifier ou en supprimer.</p>
    <form class="w3-container" action=<?= $_SERVER['REQUEST_URI'] ?> method="POST">

        <div class="w3-row-padding" style="display: flex; justify-content: center; align-items: center;">
            <div class="w3-half" style="text-align: center;">

                <input class="w3-btn w3-blue-grey" type="submit" name="create" value="Créer un enseignant"/>
                <input class="w3-btn w3-blue-grey" type="submit" name="list" value="Lister les enseignants"/>

            </div>
        </div>

    </form>
</div>