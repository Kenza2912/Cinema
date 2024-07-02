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

    public function listActeurs() {
        $pdo = Connect::seConnecter(); 
        // On exécute la requête de notre choix
        $requete = $pdo->query("SELECT CONCAT(p.nom, ' ', p.prenom) AS acteur FROM acteur a LEFT JOIN personne p ON a.id_personne = p.id_personne"); 
        require "view/listActeurs.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }

    public function home() {
        require "view/home.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }



}


// Pour interpréter les données renvoyées par la requêtes, deux choix s'offrent à nous 
// :On fetch s'il n'y a qu'un seul résultat attendu (une ligne sur HeidiSQL) --> retourne un tableau associatif 
// On fetchAll si un ensemble de résultats est attendu (plusieurs lignes sur HeidiSQL) --> retourne un tableau de tableaux associatifs

// Le fichier CinemaController.php sert à gérer les actions liées aux films et aux acteurs. Contient l'ensemble des requêtes dans les fonctions en relation avec les vues 