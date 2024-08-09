



<?php ob_start();
    $role= $requeteRole->fetch() ?>

        <h2><?= $role["nomPersonnage"] ?></h2>

    
    <?php
        foreach($requeteDetailRole->fetchAll() as $Detailrole){
    ?>
         <p>film joué : <a href="index.php?action=detailFilm&id=<?=$Detailrole["id_film"]?>"><?= $Detailrole["titre"] ?></a>. <br> Interpreted by : <a href ="index.php?action=detailRole&id=<?= $Detailrole["id_acteur"] ?>"><?= $Detailrole["acteur"] ?></a></p>
    <?php        
         }
    ?>



   
    
    <form action="index.php?action=supprimerRole&id=<?=$role["id_role"]?>" method="post">
    <button name="supprimerRole" type="submit">Supprimer</button>   
</form>

<?php
$titre = "Détails du role";
$titre_secondaire = "Détails du role";
$contenu = ob_get_clean();
require "view/template.php";