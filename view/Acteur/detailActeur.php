



<?php ob_start();
$acteur=$requete->fetch() ?>

 
    <h1><?= $acteur['prenom'] ?> <?= $acteur['nom']?></h1>
    <p>Sexe : <?= $acteur['sexe'] ?></p>
    <p>Date de Naissance : <?= $acteur['dateNaissance'] ?></p>

    <h2> Les films dans lesquels l’acteur a joué</h2>

    <?php
        foreach($requeteFilms->fetchAll() as $film){
    ?>
        <p><a href="index.php?action=detailFilm&id=<?= $film["id_film"]?>"><?= $film["titre"] ?></a></p>
    <?php        
         }
    ?>
    <form action="index.php?action=supprimerActeur&id=<?=$acteur["id_acteur"]?>" method="post">
    <button name="supprimerActeur" type="submit">Supprimer</button>   
</form>

<?php
$titre = "Détails de l'acteur";
$titre_secondaire = "Détails de l'acteur";
$contenu = ob_get_clean();
require "view/template.php";