<?php

ob_start();

?>
<div >

<form  action="index.php?action=ajouterRealisateur" method="post" >
    
    <h1>"Ajouter un réalisateur ou une réalisatrice</h1>
    
    <div >
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" required="required">
    </div>
    <div >
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" required="required">
    </div>

    <div >

        <label for="sexe">Sexe</label>
            H:<input type="radio" name="sexe" class="radio" value="H" >
            F:<input type="radio" name="sexe" class="radio" value="F">
            AUTRE :<input type="radio" name="sexe" class="radio" value="Autre">
    </div>

    <div>
        <label for="dateNaissance">Date de naissance</label>
        <input type="date" name="dateNaissance" id="dateNaissance" max="<?= date('Y-m-d');?>"required>
    </div>
    
    <div >
        <input type="submit"  name="submitRealisateur" id="submitRealisateur">

    </div>
</form>
</div>
<?php
$titre = "Ajouter un réalisateur ";
$titre_secondaire = "Ajouter un réalisateur ";
$contenu = ob_get_clean();
require "view/template.php";
