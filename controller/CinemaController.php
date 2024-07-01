<?php


namespace Controller; 

// On se connecte
use Model\Connect; 

class CinemaController{


    public function listFilms() {
        $pdo = Connect::seConnecter(); 
        // On exécute la requête de notre choix
        $requete = $pdo->query("SELECT titre FROM film"); 
        require "view/listFilms.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }
}