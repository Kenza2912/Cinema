<?php ob_start(); ?>

<div class="uk-container uk-margin-large-top">
    <?php
        $realisateur = $requeteDetailRealisateur->fetch();
    ?>
    <div class="uk-grid-small uk-flex-middle" uk-grid>
        <div class="uk-width-1-3@m uk-width-1-2@s">
            <?php if (!empty($realisateur['photo'])): ?>
                <img class="uk-border-rounded uk-box-shadow-large" src="<?= htmlspecialchars($realisateur['photo']) ?>" alt="Photo de <?= htmlspecialchars($realisateur['nom']) ?>" style="width: 100%; height: auto;">
            <?php else: ?>
                <p>Aucune image disponible.</p>
            <?php endif; ?>
        </div>
        <div class="uk-width-2-3@m uk-width-expand@s">
            <h2 class="uk-heading-large"><?= htmlspecialchars($realisateur["prenom"]) . " " . htmlspecialchars($realisateur["nom"]) ?></h2>
            <h3 class="heading" >Details :</h3>
            <p>Sexe : <?= htmlspecialchars($realisateur["sexe"]) ?></p>
            <p>Date de Naissance : <?= htmlspecialchars($realisateur["dateNaissance"]) ?></p>
        </div>
    </div>

    <div class="uk-margin-top">
        <h3 class="heading">Films réalisés</h3>
        <?php foreach($requeteFilms->fetchAll() as $film): ?>
            <p><a class="uk-button uk-button-primary" href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>"><?= htmlspecialchars($film["titre"]) ?></a></p>
        <?php endforeach; ?>
    </div>

    <div class="uk-margin-large-top">
        <form action="index.php?action=supprimerRealisateur&id=<?= $realisateur["id_realisateur"] ?>" method="post">
            <button class="uk-button uk-button-danger" name="supprimerRealisateur" type="submit">Supprimer le réalisateur</button>  
        </form>
    </div>
</div>

<?php
$titre = "Détails du réalisateur";
$titre_secondaire = "Détails du réalisateur";
$contenu = ob_get_clean();
require "view/template.php";
?>
