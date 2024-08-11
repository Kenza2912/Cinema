<?php ob_start(); ?>

<div class="form-container">
   

    <form action="index.php?action=ajouterFilm" method="POST" enctype="multipart/form-data">
        
        <div class="form-grid">
            <div>
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" required>
            </div>

            <div>
                <label for="annee">Date de parution</label>
                <input type="date" name="annee" id="annee" max="<?= date('Y-m-d'); ?>" required>
            </div>
        </div>

        <div class="form-grid">
            <div>
                <label for="duree">Durée en minutes</label>
                <input name="duree" id="duree" type="number" min="1" required>
            </div>

            <div>
                <label for="note">Note</label>
                <input type="number" step="0.01" name="note" id="note" min="1" max="5" required>
            </div>
        </div>

        <div>
            <label for="resume">Résumé du film</label>
            <textarea name="resume" id="resume" required></textarea>
        </div>

        <div class="form-grid">
            <div>
                <label for="affiche">Image du film</label>
                <input name="affiche" id="affiche" type="file" required>
            </div>

            <div>
                <label for="realisateur">Réalisateur</label>
                <select name="realisateur" id="realisateur">
                    <?php foreach($requeteRealisateur->fetchAll() as $realisateur){ ?>
                        <option value="<?= $realisateur["id_realisateur"]?>"><?= $realisateur["realisateur"] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div>
            <label>Genre</label>
            <select name="genre[]" multiple>
                <?php foreach($requeteGenre->fetchAll() as $genre){ ?>
                    <option value="<?= $genre["id_genre"]?>"><?= $genre["libelle"]?></option>
                <?php } ?>
            </select>
        </div>

        <div>
            <button type="submit" name="submitFilm">Ajouter le film</button>
        </div>
    </form>
</div>

<?php
$titre = "Ajouter un film";
$titre_secondaire = "Ajouter un film ";
$contenu = ob_get_clean();
require "view/template.php";
?>
