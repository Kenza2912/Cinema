<?php ob_start(); ?>

<p class="uk-text-lead">Il y a <?= $requeteRealisateur->rowCount() ?> réalisateurs</p>

<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">

    <ul class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-3@m uk-grid">
        <?php foreach ($requeteRealisateur->fetchAll() as $realisateur) { ?>
            <li>
                <div class="realisateur-container uk-inline uk-light">
                    <?php if (!empty($realisateur['photo'])): ?>
                        <img src="<?= htmlspecialchars($realisateur['photo'] ?? '') ?>" alt="Photo de <?= htmlspecialchars($realisateur['nom'] ?? 'Inconnu') ?>" class="realisateur-image-cover">
                    <?php else: ?>
                        <div class="uk-card-body">
                            <p>Aucune image disponible.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="realisateur-details uk-text-center uk-margin-top">
                    <h3 class="uk-card-title realisateur-nom"><a href="index.php?action=detailRealisateur&id=<?=$realisateur['id_realisateur'] ?>" class="uk-link-reset"><?= htmlspecialchars($realisateur['realisateur'] ?? 'Inconnu') ?></a></h3>
                </div>
            </li>
        <?php } ?>
    </ul>

    <!-- Flèches de navigation -->
    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>

<div class="uk-margin-top">
    <button class="uk-button uk-button-primary"><a href="index.php?action=afficherFormulaireRealisateur" class="uk-link-reset">Ajouter un réalisateur</a></button>
</div>

<?php
$titre = "Liste des réalisateurs"; 
$titre_secondaire = "Liste des réalisateurs"; 
$contenu = ob_get_clean();
require "view/template.php";