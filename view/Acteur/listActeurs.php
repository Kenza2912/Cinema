
<!-- Chaque vue aura la structure suivante : -->

<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()" -->
<?php ob_start(); ?>

<p class="uk-text-lead">Il y a <?= $requete->rowCount() ?> acteurs</p>

<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">

    <ul class="uk-slider-items uk-child-width-1-3@s uk-child-width-1-4@m uk-grid">
        <?php foreach ($requete->fetchAll() as $acteur) { ?>
            <li>
                <div class="acteur-container uk-inline uk-light">
                    <?php if (!empty($acteur['photo'])): ?>
                        <img src="<?= htmlspecialchars($acteur['photo'] ?? '') ?>" alt="Photo de <?= htmlspecialchars($acteur['nom'] ?? 'Inconnu') ?>" class="acteur-image-cover">
                    <?php else: ?>
                        <div class="uk-card-body">
                            <p>Aucune image disponible.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="acteur-details uk-text-center uk-margin-top">
                    <h3 class="uk-card-title acteur-nom"><a href="index.php?action=detailActeur&id=<?=$acteur['id_acteur'] ?>" class="uk-link-reset"><?= htmlspecialchars($acteur['acteur'] ?? 'Inconnu') ?></a></h3>
                </div>
            </li>
        <?php } ?>
    </ul>

    <!-- Flèches de navigation -->
    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>

<div class="uk-margin-top">
    <button class="uk-button uk-button-primary"><a href="index.php?action=afficherFormulaireActeur" class="uk-link-reset">Ajouter un Acteur ou une Actrice</a></button>
</div>

<?php
$titre = "Liste des acteurs"; 
$titre_secondaire = "Liste des acteurs"; 
$contenu = ob_get_clean();

require "view/template.php";

// On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu


// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php