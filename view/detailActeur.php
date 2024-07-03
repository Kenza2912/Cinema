



<?php ob_start();
$acteur=$requete->fetch() ?>

 
    <h1><?= $acteur['prenom'] ?> <?= $acteur['nom']?></h1>
    <p>Sexe : <?= $acteur['sexe'] ?></p>
    <p>Date de Naissance : <?= $acteur['dateNaissance'] ?></p>


<?php
$titre = "Détails de l'acteur";
$titre_secondaire = "Détails de l'acteur";
$contenu = ob_get_clean();
require "view/template.php";