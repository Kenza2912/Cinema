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

<header>
        <nav class="uk-navbar-container navbar" uk-navbar>
            <div class="uk-navbar-left">
                <a href="home.php" class="uk-navbar-item uk-logo">Cinéma de Kenza</a>
            </div>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li><a href="index.php?action=home">Home</a></li>
                    <li><a href="index.php?action=listFilms">Films</a></li>  
                    <li><a href="index.php?action=listActeurs">Acteurs</a></li> 
                    <li> <a href="index.php?action=listGenres">GENRES</a></li>  
                    <li><a href="index.php?action=listRealisateur">Réalisateur</a></li>    
                    <li><a href="index.php?action=listRoles">Casting</a></li> 
                    <li><a href="ajouterFilm.php" class="uk-button uk-button-primary uk-button-small">Ajouter un Film</a></li>
                </ul>
            </div>
        </nav>
</header>


    <div class="hero">
        <div class="uk-text-center">
            
                <h1 class="uk-heading-divider">PDO Cinema</h1>
               
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
                <?= $contenu ?>

          
        </div>
    </div>



    <footer>
        <p>© 2024 Cinéma - Tous droits réservés</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/js/uikit-icons.min.js"></script>
</body>
</html>


<!-- ce fichier sert de modèle pour toutes les vues  -->