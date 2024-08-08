<?php

namespace Controller;
use Model\Connect; //l'utilisation du "use" est pour accéder à la classe Connect située dans la couche "Model" (avec la BDD)

class GenreController {

     //Lister les genres
     public function listGenres(){
        $pdo = Connect::seConnecter();
        $requeteGenre = $pdo->query("SELECT g.id_genre, g.libelle FROM genre g ORDER BY g.libelle");
        $requeteGenre->execute();
        require "view/Genre/viewGenre.php";
    }

      //Afficher les détails d'un genre (films reliés)
      public function detailsGenre($id){
        $pdo = Connect::seConnecter(); 

        $requeteDetailsGenre = $pdo->prepare("SELECT id_genre, libelle FROM genre WHERE id_genre = :id
        ");
        $requeteDetailsGenre->execute(["id"=> $id]);

        $requeteFilm = $pdo->prepare("SELECT f.id_film, f.titre, f.affiche, f.annee, CONCAT(prenom, ' ', nom) as realisateur, f.id_realisateur
            FROM film f, appartient a, genre g, personne p, realisateur re
            WHERE f.id_film = a.id_film
            AND a.id_genre = g.id_genre
            AND f.id_realisateur = re.id_realisateur
            AND re.id_personne = p.id_personne
            AND g.id_genre = :id
            ORDER BY titre");
    
        $requeteFilm->execute(["id" => $id]);

        require("view/Genre/detailsGenre.php");
    }

 //Ajouter genre
 public function ajouterGenre(){
    if(isset($_POST["submitGenre"])){
        $libelle = filter_input(INPUT_POST, "libelle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if($libelle){
            $pdo = Connect::seConnecter(); 
            $requeteAjouteGenre = $pdo->prepare("INSERT INTO genre (libelle) VALUES ('$libelle')");
            $requeteAjouteGenre->execute();
        }
    }
    require "view/home.php";
   
}

public function afficherFormulaireGenre() {
    require "view/Genre/ajouterGenre.php";
}

 //Supprimer un genre
 public function supprimerGenre($id){

    if(isset($_POST["GenreSupprimer"])){  
        $pdo = Connect::seConnecter(); 
        $requeteSupprimeGenre = $pdo->prepare("DELETE FROM genre WHERE id_genre = :id");
        $requeteSupprimeGenre->execute(["id" => $id]);
    }
    require "view/home.php";
}


}