<?php ob_start(); ?>

<div class="form-container">
    

    <form action="index.php?action=ajouterActeur" method="post" enctype="multipart/form-data">
        <div class="form-grid">
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" required>
            </div>
        </div>

        <div class="radio-container">
            <label for="sexe">Sexe</label>
            H: <input type="radio" name="sexe" value="H">
            F: <input type="radio" name="sexe" value="F">
            Autre: <input type="radio" name="sexe" value="Autre">
        </div>

        <div>
            <label for="dateNaissance">Date de naissance</label>
            <input type="date" name="dateNaissance" id="dateNaissance" max="<?= date('Y-m-d'); ?>" required>
        </div>

        <div>
            <label for="photo">Image de l'acteur</label>
            <input name="photo" id="photo" type="file" required>
        </div>

        <div>
            <input type="submit" name="submitActeur" id="submitActeur" value="Ajouter l'acteur">
        </div>
    </form>
</div>

<?php
$titre = "Ajouter un acteur";
$titre_secondaire = "Ajouter un acteur ou une actrice";
$contenu = ob_get_clean();
require "view/template.php";