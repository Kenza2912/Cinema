


<?php ob_start();
$acteur = $requete->fetch();
?>

<div class="uk-container uk-margin-large-top">
    <div class="uk-grid-small uk-flex-middle" uk-grid>
        <div class="uk-width-1-3@m uk-width-1-2@s">
            <?php if (!empty($acteur['photo'])): ?>
                <img class="uk-border-rounded uk-box-shadow-large" src="<?= htmlspecialchars($acteur['photo']) ?>" alt="Photo de <?= htmlspecialchars($acteur['nom']) ?>" style="width: 100%; height: auto;">
            <?php else: ?>
                <p>Aucune image disponible.</p>
            <?php endif; ?>
        </div>
        <div class="uk-width-2-3@m uk-width-expand@s">
            <h2 class="uk-heading-large"><?= htmlspecialchars($acteur['prenom']) ?> <?= htmlspecialchars($acteur['nom']) ?></h2>
            <p>Sexe : <?= htmlspecialchars($acteur['sexe']) ?></p>
            <p>Date de Naissance : <?= htmlspecialchars($acteur['dateNaissance']) ?></p>
        </div>
    </div>

    <div class="uk-margin-top">
        <h2>Les films dans lesquels l’acteur a joué</h2>
        <?php foreach($requeteFilms->fetchAll() as $film): ?>
            <p><a class="uk-button uk-button-primary" href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>"><?= htmlspecialchars($film["titre"]) ?></a></p>
        <?php endforeach; ?>
    </div>

    <div class="uk-margin-large-top">
        <form action="index.php?action=supprimerActeur&id=<?= $acteur["id_acteur"] ?>" method="post">
            <button class="uk-button uk-button-danger" name="supprimerActeur" type="submit">Supprimer l'acteur</button>   
        </form>
    </div>
</div>

<?php
$titre = "Détails de l'acteur";
$titre_secondaire = "Détails de l'acteur";
$contenu = ob_get_clean();
require "view/template.php";

