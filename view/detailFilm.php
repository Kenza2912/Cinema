

<!-- Chaque vue aura la structure suivante  -->

<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()"  -->

<?php ob_start();
$film = $requete->fetch();
?>

<div class="uk-container uk-margin-large-top">
    <div class="uk-grid-small uk-flex-middle" uk-grid>
        <div class="uk-width-1-3@m uk-width-1-2@s">
            <?php if (!empty($film['affiche'])): ?>
                <img class="uk-border-rounded" src="<?= htmlspecialchars($film['affiche']) ?>" alt="Affiche du film <?= htmlspecialchars($film['titre']) ?>" style="width: 100%; height: auto;">
            <?php else: ?>
                <p>Aucune image disponible.</p>
            <?php endif; ?>
        </div>
        <div class="uk-width-2-3@m uk-width-expand@s">
            <table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <th>TITRE</th>
                        <th>ANNEE</th>
                        <th>DUREE</th>
                        <th>REALISATEUR</th>
                        <th>RESUME</th>
                        <th>NOTE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($film["titre"]) ?></td>
                        <td><?= htmlspecialchars($film["annee"]) ?></td>
                        <td><?= htmlspecialchars($film["duree"]) ?> min</td>
                        <td><?= htmlspecialchars($film["realisateur"]) ?></td>
                        <td><?= htmlspecialchars($film["resume"]) ?></td>
                        <td><?= htmlspecialchars($film["note"]) ?>/5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="uk-margin-top uk-flex">
        <div class="uk-width-1-2">
            <h3 class="uk-heading-line"><span>Genres</span></h3>
            <p>
                <?php $genres = $requeteGenres->fetchAll(); ?>
                <?php if (!empty($genres)): ?>
                    <?php foreach ($genres as $genre): ?>
                        <span class="uk-label uk-label-success uk-margin-small-right"><?= htmlspecialchars($genre['libelle']) ?></span>
                    <?php endforeach; ?>
                <?php else: ?>
                    Aucun genre disponible.
                <?php endif; ?>
            </p>
        </div>
        <div class="uk-width-1-2">
            <h3 class="uk-heading-line"><span>Casting</span></h3>
            <p>
                <?php $casting = $requeteCasting->fetchAll(); ?>
                <?php if (!empty($casting)): ?>
                    <ul class="uk-list uk-list-bullet">
                        <?php foreach ($casting as $cast): ?>
                            <li><?= htmlspecialchars($cast['acteur']) ?> dans le rôle de <?= htmlspecialchars($cast['nomPersonnage']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    Aucun acteur disponible.
                <?php endif; ?>
            </p>
        </div>
    </div>

    <div class="uk-margin-top">
        <form method="post" action="index.php?action=supprimerFilm&id=<?= $film["id_film"]?>">
            <button class="uk-button uk-button-danger" name="supprimerFilm" type="submit">Supprimer le film</button>
        </form>
    </div>
</div>

<?php

$titre = "Détails du film"; 
$titre_secondaire = "Détails du film"; 
$contenu = ob_get_clean();
require "view/template.php";



// On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu


// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php