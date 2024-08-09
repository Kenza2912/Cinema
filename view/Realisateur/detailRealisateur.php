<?php ob_start(); ?>

<div>
    <?php
        $realisateur = $requeteDetailRealisateur->fetch();
    ?>
        <h2><?= $realisateur["prenom"] . " " . $realisateur["nom"] ?></h2>

        <h3>Details : </h3>
        <p>Sexe : <?= $realisateur["sexe"]?></p>
        <p>Date de Naissance : <?= $realisateur["dateNaissance"] ?></p>

       
        

        <h3>Films réalisés</h3>
    <?php
        foreach($requeteFilms->fetchAll() as $film){
    ?>
        <p><a href="index.php?action=detailFilm&id=<?=$film["id_film"]?>"><?= $film["titre"] ?></a></p>
    <?php        
         }
    ?>
</div>

<form action="index.php?action=supprimerRealisateur&id=<?=$realisateur["id_realisateur"]?>" method="post">
    <button name="supprimerRealisateur" type="submit">Supprimer</button>  
</form>


<?php

// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et $titre_secondaire


$titre = "Détails des réalisateurs"; 
$titre_secondaire = "Détails des réalisateurs"; 
$contenu = ob_get_clean();
require "view/template.php";