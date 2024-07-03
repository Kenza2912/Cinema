
<!-- Chaque vue aura la structure suivante : -->

<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()" -->
<?php ob_start(); ?>
<p class="uk-table uk-table-striped"> Il y a <?= $requete->rowCount() ?> acteurs </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>NOM et PRENOM</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($requete->fetchAll() as $acteur) { ?>
                <tr>
                    <td><?= $acteur["acteur"] ?></td>
                    <td><a href="index.php?action=detailActeur&id=<?=$acteur['id_acteur'] ?>" ><?= $acteur["acteur"] ?></a></td>
                </tr>
       <?php } ?>
    </tbody>
</table>

<?php

// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et $titre_secondaire


$titre = "Liste des acteurs"; 
$titre_secondaire = "Liste des acteurs"; 
$contenu = ob_get_clean();

// On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu

require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php