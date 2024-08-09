<?php

session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="./public/css/style.css">
    <title><?= $titre ?></title>
</head>
<body>


    <nav>
        <a href="index.php?action=home">Home</a>
        <a href="index.php?action=listFilms">Films</a>
        <a href="index.php?action=listActeurs">Acteurs</a>
        <a href="index.php?action=listGenres">GENRES</a>
        <a href="index.php?action=listRealisateur">Réalisateur</a>
        <a href="index.php?action=listRoles">Casting</a>
    </nav>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <h1 class="uk-heading-divider">PDO Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
                <?= $contenu ?>

            </div>
        </main>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/js/uikit-icons.min.js"></script>
</body>
</html>


<!-- ce fichier sert de modèle pour toutes les vues  -->