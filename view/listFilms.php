
<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()" -->
<?php ob_start(); ?>
<p class="uk-table uk-table-striped"> Il y a <?=requete->rowCount () ?> films </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["titre"] ?></td>
                    <td><?= $film["annee_sortie"] ?></td>
                </tr>
       <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des films"; 
$titre_secondaire = "Liste des films"; 
$contenu = ob_get_clean();

// On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu

require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php