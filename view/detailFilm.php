

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
             <?php
            foreach ($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["titre"] ?></td>
                    <td><?= $film["annee"] ?></td>
                    <td><?= $film["duree"] ?></td>
                    <td><?= $film["realisateur"]?></td>
                    <td><?= $film["resume"] ?></td>
                    <td><?= $film["note"] ?></td>
                </tr>
             <?php } ?>
    </tbody>
</table>

<?php

// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et $titre_secondaire


$titre = "Détails du film"; 
$titre_secondaire = "Détails du film"; 
$contenu = ob_get_clean();

// On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu

require "view/template.php";

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php