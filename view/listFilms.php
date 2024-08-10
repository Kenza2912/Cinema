
<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()" -->
<?php ob_start(); ?>

<p class="uk-text-lead">Il y a <?= $requete->rowCount() ?> films</p>

<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">

    <ul class="uk-slider-items uk-child-width-1-3@s uk-child-width-1-5@m uk-grid">
        <?php foreach ($requete->fetchAll() as $film) { ?>
            <li>
                <div class="film-container uk-inline uk-light">
                    <?php if (!empty($film['affiche'])): ?>
                        <img src="<?= htmlspecialchars($film['affiche']) ?>" alt="Affiche du film <?= htmlspecialchars($film['titre']) ?>" class="film-image-full">
                        <div class="uk-overlay uk-overlay-primary uk-position-center">
                            <a href="index.php?action=detailFilm&id=<?=$film['id_film'] ?>" uk-icon="icon: play-circle; ratio: 1.5" class="film-icon"></a>
                        </div>
                    <?php else: ?>
                        <div class="uk-card-body">
                            <p>Aucune image disponible.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="film-details uk-text-center uk-margin-top">
                    <h3 class="uk-card-title film-title"><a href="index.php?action=detailFilm&id=<?=$film['id_film'] ?>" class="uk-link-reset"><?= htmlspecialchars($film['titre']) ?></a></h3>
                    <p class="film-year">Année: <?= htmlspecialchars($film["annee"]) ?></p>
                </div>
            </li>
        <?php } ?>
    </ul>

    <!-- Flèches de navigation -->
    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>

<div class="uk-margin-top">
    <button class="uk-button uk-button-primary"><a href="index.php?action=afficherFormulaireFilm" class="uk-link-reset">Ajouter un film</a></button>
</div>

<?php
$titre = "Liste des films"; 
$titre_secondaire = "Liste des films"; 
$contenu = ob_get_clean();

require "view/template.php";