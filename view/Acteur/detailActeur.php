



<?php ob_start();
$acteur=$requete->fetch() ?>

 
    <h2 class="uk-heading-large"><?= $acteur['prenom'] ?> <?= $acteur['nom']?></h2>
    
    <p>Sexe : <?= $acteur['sexe'] ?></p>
    <p>Date de Naissance : <?= $acteur['dateNaissance'] ?></p>

    <?php if (!empty($acteur['photo'])): ?>
    <img class="image" src="<?= htmlspecialchars($acteur['photo']) ?>" alt="Affiche de  <?= htmlspecialchars($acteur['nom']) ?>">
<?php else: ?>
    <p>Aucune image disponible.</p>
<?php endif; ?>

    <h2> Les films dans lesquels l’acteur a joué</h2>

    <?php
        foreach($requeteFilms->fetchAll() as $film){
    ?>
        <p><a class="uk-button uk-button-danger" href="index.php?action=detailFilm&id=<?= $film["id_film"]?>"class="uk-card-title"><?= $film["titre"] ?></a></p>
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