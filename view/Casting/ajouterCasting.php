<?php ob_start();?>


<div >
<form action="index.php?action=ajouterCasting" method="POST" >
    
    <p>Ajouter un acteur ou une actrice à un rôle et au film joué </p>
    
    
    <div >
        <label for="film">Film </label>
        <select name="film" id="film" required>

                <?php foreach($requeteFilm->fetchAll() as $film){?>
                    <option value="<?= $film["id_film"] ?>"><?= $film["titre"]?></option>
                <?php }?>

            </select>
        </div>

    <div >
         <label for="acteur">Acteur ou Actrice</label>      
        <select name="acteur" id="acteur" required>
        
                <?php foreach($requeteActeur->fetchAll() as $acteur){?>
                     <option value="<?= $acteur["id_acteur"] ?>"><?= $acteur["acteur"] ?></option>
                <?php }?>
        
        </select>
     </div>

     <div >
        <label for="role">Role </label>
        <select name="role" id="role" required>

                 <?php foreach($requeteRole->fetchAll() as $role){?>
                    <option value="<?= $role["id_role"] ?>"><?= $role["nomPersonnage"] ?></option>
                <?php } ?>

        </select>

    </div>
    <div >
        <input type="submit" name="submitCasting" id="submitCasting">
    </div>
</form>

<?php
$titre = "Ajouter un casting";
$titre_secondaire = "Ajouter un casting";
$contenu = ob_get_clean();
require "view/template.php";