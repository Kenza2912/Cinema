<?php ob_start(); ?>

<div class="uk-container uk-margin-large-top">
    <button class="uk-button uk-button-primary uk-margin-bottom">
        <a href="index.php?action=afficherFormulaireGenre" class="uk-link-reset">Ajouter un genre</a>
    </button>

    <div class="uk-flex uk-flex-wrap uk-child-width-1-4@m uk-grid-small uk-grid-match" uk-grid>
        <?php
            foreach($requeteGenre->fetchAll() as $genre){ ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body uk-box-shadow-medium uk-text-center">
                        <a href="index.php?action=detailsGenre&id=<?=$genre["id_genre"]?>" class="uk-link-reset uk-text-bold"><?= $genre["libelle"] ?></a>
                    </div>
                </div>
        <?php  } ?>
    </div>
</div>

<?php
$titre = "Genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";
//Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php