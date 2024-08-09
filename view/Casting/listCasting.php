

<?php ob_start(); ?>
<p class="uk-table uk-table-striped"> Il y a <?= $requeteRole->rowCount() ?> rôles </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Personnages</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($requeteRole->fetchAll() as $role) { ?>
                <tr>
                   
                    <td><a href="index.php?action=detailRole&id=<?=$role['id_role'] ?>" ><?= $role["nomPersonnage"] ?></a></td>
                </tr>
       <?php } ?>
    </tbody>
</table>
<button><a href="index.php?action=afficherFormulaireRole">Ajouter un personnage </a></button>

<?php




$titre = "Liste des perosnnages "; 
$titre_secondaire = "Liste des perosnnages"; 
$contenu = ob_get_clean();

require "view/template.php";