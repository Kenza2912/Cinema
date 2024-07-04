<?php


namespace Controller;

// On se connecte
use Model\Connect; 

class CinemaController{


    public function listFilms() {
        $pdo = Connect::seConnecter(); 
        // On exécute la requête de notre choix
        $requete = $pdo->query("SELECT f.id_film, titre, annee FROM film f"); 
        require "view/listFilms.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }

    public function listActeurs() {
        $pdo = Connect::seConnecter(); 
        // On exécute la requête de notre choix
        $requete = $pdo->query("SELECT a.id_acteur, CONCAT(p.nom, ' ', p.prenom) AS acteur FROM acteur a LEFT JOIN personne p ON a.id_personne = p.id_personne"); 
        require "view/listActeurs.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }

    public function home() {
        require "view/home.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }

    public function detailFilm($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT f.id_film, f.titre, f.annee, f.duree, f.resume, f.note, f.affiche, CONCAT(p.nom, ' ', p.prenom) AS realisateur FROM film f JOIN realisateur r ON f.id_realisateur = r.id_realisateur JOIN personne p ON r.id_personne= p.id_personne WHERE f.id_film = :id");
        $requete->execute(["id" => $id]);
        
        $requeteGenres = $pdo->prepare("SELECT g.libelle FROM genre g JOIN appartient a ON g.id_genre = a.id_genre WHERE a.id_film = :id");
        $requeteGenres->execute(['id' => $id]);
      
        $requeteCasting = $pdo->prepare("SELECT CONCAT(p.nom, ' ', p.prenom) AS acteur, r.nomPersonnage FROM casting c JOIN acteur a ON c.id_acteur = a.id_acteur JOIN personne p ON a.id_personne = p.id_personne JOIN role r ON c.id_role= r.id_role WHERE c.id_film = :id");
        $requeteCasting->execute(['id' => $id]);

        require "view/detailFilm.php";
    }

    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
         
        $requete= $pdo->prepare("SELECT a.id_acteur, p.nom, p.prenom, p.sexe, p.dateNaissance FROM personne p JOIN acteur a ON p.id_personne = a.id_personne WHERE a.id_acteur = :id"); 
        $requete->execute(["id" => $id]);

        // $acteur = $requete->fetch();

        // if (!$requete) {
        //     // Redirigez ou affichez un message d'erreur si l'acteur n'est pas trouvé
        //     die('Acteur non trouvé.');
        // } else {
        //     // Debugging: afficher le contenu de $acteur
        //     echo "<pre>";
        //     print_r($acteur);
        //     echo "</pre>";
        // }



        require "view/detailActeur.php";
       
    }



}


// Pour interpréter les données renvoyées par la requêtes, deux choix s'offrent à nous 
// :On fetch s'il n'y a qu'un seul résultat attendu (une ligne sur HeidiSQL) --> retourne un tableau associatif 
// On fetchAll si un ensemble de résultats est attendu (plusieurs lignes sur HeidiSQL) --> retourne un tableau de tableaux associatifs

// Le fichier CinemaController.php sert à gérer les actions liées aux films et aux acteurs. Contient l'ensemble des requêtes SQL dans les fonctions en relation avec les vues 