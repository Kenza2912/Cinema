<?php

ob_start();

?>
<div class="container-form">

<form action="index.php?action=ajouterGenre" method="post" >
    
    <h1>Ajouter un genre</h1>

    <div>
        <label>Nom du genre</label>
        <input type="text"  name="libelle" id="libelle" required>
    </div>
 
    <div >
        <input name="submitGenre" type="submit" >
    </div>
    
</form>
</div>

<?php
$titre = "Ajouter un genre";
$titre_secondaire = "Ajouter un genre";
$contenu = ob_get_clean();
require "view/template.php";
//Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php