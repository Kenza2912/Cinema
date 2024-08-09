<?php ob_start(); ?>

<p class="uk-table uk-table-striped"> Il y a <?= $requeteRealisateur->rowCount() ?> réalisateurs </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>NOM et PRENOM</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($requeteRealisateur->fetchAll() as $realisateur) { ?>
                <tr>
                   
                    <td><a href="index.php?action=detailRealisateur&id=<?=$realisateur['id_realisateur'] ?>" ><?= $realisateur["realisateur"] ?></a></td>
                </tr>
       <?php } ?>
    </tbody>
</table>

<button ><a href="index.php?action=afficherFormulaireRealisateur">Ajouter un réalisateur</a></button>

<?php

// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et $titre_secondaire


$titre = "Liste des réalisateurs"; 
$titre_secondaire = "Liste des réalisateurs"; 
$contenu = ob_get_clean();
require "view/template.php";