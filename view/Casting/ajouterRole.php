<?php ob_start();?>

<div>

<form  action="index.php?action=ajouterRole" method="post">
    
    <h2>Ajouter un rôle</h2>
    
    <div>
        <label>Nom du personnage</label>
        <input type="text"  name="nomPersonnage" id="nomPersonnage" required>
    </div>
  
    <div >
        <input type="submit" class="submit" name="submitRole" id="submitRole">
    </div>
</form>

</div>

<?php
$titre = "Ajouter un rôle";
$titre_secondaire = "Ajouter un rôle";
$contenu = ob_get_clean();
require "view/template.php";