<?php

ob_start();

?>
<p>Ajouter un film </p>

<div >
    <form action="index.php?action=ajouterFilm" method="POST" enctype="multipart/form-data" >
        
        
        
        <div >
            <label for="titre">titre</label>
            <input type="text" name="titre" id="titre" required="required">    
        </div>

        <div>
            <label for="annee">Date de parution</label>
            <input type="date" name="annee" id="annee" max="<?= date('Y-m-d');?>"required>
        </div>

        <div >
            <label for="duree">Durée en minutes </label>
            <input name="duree" id="duree" type="number" min="1"   required>
        </div>

        <div>
            <label for="resume" >Résumé du film </label>
            <textarea name="resume" id="resume" type="text" rows="10" cols="50"  required></textarea>
        </div>

        <div >
            <label for="note">Note </label>
            <input type="number" step="0.01" name="note" id="note" min="1" max="5"  required>   
        </div>

        <div >
            <label for="affiche">Image du film</label>
            <input name="affiche" id="affiche" type="file" required>
        </div>

        <div>
            <label for="realisateur">Réalisateur</label>
                <select name="realisateur" id="realisateur">

                    <?php foreach($requeteRealisateur->fetchAll() as $realisateur){?>
                        <option value="<?= $realisateur["id_realisateur"]?>"><?= $realisateur["realisateur"] ?></option>
                    <?php }?>
                </select>
        </div>
        <div >
            <label>Genre </label>
                <select name="genre[]" type="text"  multiple>   
                    <?php foreach($requeteGenre->fetchAll() as $genre){?>
                        <option value="<?= $genre["id_genre"]?>"><?= $genre["libelle"]?></option>
                    <?php }?>
                </select>
        </div>

        
    
        <div>
            <input type="submit" name="submitFilm" id="submitFilm" >
        </div>
    </form>

<?php
$titre = "Ajouter un film";
$titre_secondaire = "Ajouter un film ";
$contenu = ob_get_clean();
require "view/template.php";