<?php

ob_start();

?>

<!-- Affichage des détails d'un genre -->
<section >
<div>
    <?php
        $genre = $requeteDetailsGenre->fetch();
    ?>
        <h2><?= $genre["libelle"] ?></h2>
        <h3>Genre </h3>
        <table>
            <thead>
            <?php
        foreach($requeteFilm->fetchAll() as $film){
    ?>
                <tr>
                    <th><a href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><?= $film["titre"] ?></th>
                </tr>
                <?php } ?>
            </thead>
            <tbody>
                <tr>
                    <td><?=$film['affiche'] ?></td>
                </tr>
            </tbody>
        </table>
   

<div >
    <form action="index.php?action=supprimerGenre&id=<?=$genre["id_genre"]?>" method="post">
        <button name="GenreSupprimer" type="submit">Supprimer</button>
    </form>
    
</div>
</div>
</section>
<?php
$titre = "Genre details";
$titre_secondaire = "Liste des films pour le genre :";
$contenu = ob_get_clean();
require "view/template.php";
//Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php