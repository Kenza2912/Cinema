

<!-- Chaque vue aura la structure suivante  -->

<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()"  -->
<?php ob_start();
$film=$requete->fetch()  ?>


<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE</th>
            <th>DUREE</th>
            <th>NOM et PRENOM</th>
            <th>RESUME</th>
            <th>NOTE</th>
            
        </tr>
    </thead>
    <tbody>
             
                <tr>
                    <td><?= $film["titre"] ?></td>
                    <td><?= $film["annee"] ?></td>
                    <td><?= $film["duree"] ?></td>
                    <td><?= $film["realisateur"]?></td>
                    <td><?= $film["resume"] ?></td>
                    <td><?= $film["note"] ?></td>
                </tr>
           
    </tbody>
</table>

<?php if (!empty($film['affiche'])): ?>
    <img class="image" src="<?= htmlspecialchars($film['affiche']) ?>" alt="Affiche du film <?= htmlspecialchars($film['titre']) ?>">
<?php else: ?>
    <p>Aucune image disponible.</p>
<?php endif; ?>

<?php $genres = $requeteGenres->fetchAll(); ?>
<p>Genres :
    <?php if (!empty($genres)): ?>
        <?php foreach ($genres as $genre): ?>
            <?= htmlspecialchars($genre['libelle']) ?>
        <?php endforeach; ?>
    <?php else: ?>
        Aucun genre disponible.
    <?php endif; ?>
</p>
<?php $casting = $requeteCasting->fetchAll(); ?>
<p>Casting :
    <?php if (!empty($casting)): ?>
        <ul>
            <?php foreach ($casting as $cast): ?>
                <li><?= htmlspecialchars($cast['acteur']) ?> dans le rôle de <?= htmlspecialchars($cast['nomPersonnage']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        Aucun acteur disponible.
    <?php endif; ?>
</p>

        <form method="post" action="index.php?action=supprimerFilm&id=<?= $film["id_film"]?>">
          
            <button  name="supprimerFilm" type="submit">Supprimer</button>
        </form>


<?php

// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et $titre_secondaire


$titre = "Détails du film"; 
$titre_secondaire = "Détails du film"; 
$contenu = ob_get_clean();

// On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu

require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php