<?php ob_start(); ?>


  <!-- <p>Il y a <?= $requeteGenre->rowCount() ?> genres</p> -->

<div >
    <button><a href="index.php?action=afficherFormulaireGenre">Ajouter un genre</a></button>
</div>
    <div>
    <table>
        <thead>
            <tr>
                <th>GENRES</th>
            
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requeteGenre->fetchAll() as $genre){ ?>
                    <tr>
                        <td><a href="index.php?action=detailsGenre&id=<?=$genre["id_genre"]?>"><?= $genre["libelle"] ?></a></td>
                        
                    </tr>
            <?php  } ?>
        </tbody>
    </table>
    </div>
<?php
$titre = "Genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";
//Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php