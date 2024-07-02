<!-- Le fichier CinemaController.php sert à gérer les actions liées aux films et aux acteurs. Contient l'ensemble des 
requêtes dans les fonctions en relation avec les vues  -->

<?php


namespace Controller;

// On se connecte
use Model\Connect; 

class CinemaController{


    public function listFilms() {
        $pdo = Connect::seConnecter(); 
        // On exécute la requête de notre choix
        $requete = $pdo->query("SELECT titre, annee FROM film"); 
        require "view/listFilms.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }
}