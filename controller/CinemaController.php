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

    public function afficherFormulaireFilm(){
        $pdo = Connect::seConnecter();
        $requeteRealisateur = $pdo->query("SELECT id_realisateur, CONCAT(p.nom, ' ', p.prenom) AS realisateur FROM realisateur r JOIN personne p ON p.id_personne = r.id_personne");   
        $requeteRealisateur->execute();
    
        $requeteGenre = $pdo->query("SELECT * FROM genre");
        $requeteGenre-> execute();
        
        require ("view/ajouterFilm.php");
    }

  
    public function ajouterFilm() {
        $pdo = Connect::seConnecter();
    
        if (isset($_POST["submitFilm"])) {
            if (isset($_FILES["affiche"]) && $_FILES["affiche"]["error"] === 0) {
                // Processus d'upload de l'image
                $tmpName = $_FILES["affiche"]["tmp_name"];
                $name = $_FILES["affiche"]["name"];
                $size = $_FILES["affiche"]["size"];
                $tabExtension = explode(".", $name);
                $extension = strtolower(end($tabExtension));
                $extensions = ["jpg", "png", "jpeg"];
                $maxTaille = 4000000;
    
                if (in_array($extension, $extensions) && $size <= $maxTaille) {
                    $uniqueName = uniqid("", true);
                    $fileUnique = $uniqueName . "." . $extension;
                    move_uploaded_file($tmpName, "./public/image/" . $fileUnique);
                    $afficheChemin = "./public/image/" . $fileUnique;
                } else {
                    echo "L'image doit être au format JPG, PNG ou JPEG et ne doit pas dépasser 4MB.";
                    return;
                }
            } else {
                // Vérifications supplémentaires pour le débogage
                if ($_FILES["affiche"]["error"] !== 0) {
                    echo "Erreur lors de l'upload de l'image. Code d'erreur : " . $_FILES["affiche"]["error"];
                } else {
                    echo "Aucune image n'a été uploadée.";
                }
                return;
            }
    
            // Récupération et validation des autres champs
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $annee = filter_input(INPUT_POST, "annee", FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            $resume = filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $realisateur = filter_input(INPUT_POST, "realisateur", FILTER_SANITIZE_NUMBER_INT);
    
            // Préparation de la requête
            $requeteAjouterFilm = $pdo->prepare("INSERT INTO film (titre, annee, duree, resume, note, affiche, id_realisateur)
                                                  VALUES(:titre, :annee, :duree, :resume, :note, :afficheChemin, :realisateur)");
    
            // Exécution de la requête
            $requeteAjouterFilm->execute([
                "titre" => $titre,
                "annee" => $annee,
                "duree" => $duree,
                "resume" => $resume,
                "note" => $note,
                "afficheChemin" => $afficheChemin,
                "realisateur" => $realisateur
            ]);
            $requeteGenre = $pdo->query("SELECT id_genre, libelle FROM genre");
            $requeteGenre->execute();

            $genres = isset($_POST["genre"]) ? $_POST["genre"] : [];

            foreach ($genres as $genre) {
                $requeteAjouteGenre = $pdo->prepare("INSERT INTO appartient (id_film, id_genre) VALUES (LAST_INSERT_ID(), :id_genre)");
                $requeteAjouteGenre->execute(["id_genre" => $genre]);
            }
        }
    
        require("view/home.php");
    }

    public function supprimerFilm($id){

        $pdo = Connect::seConnecter();
        if(isset($_POST["supprimerFilm"])){
            
            $requeteSupprimerAppartient = $pdo->prepare("DELETE FROM appartient WHERE id_film = :id"); 
            $requeteSupprimerAppartient->execute(["id"=>$id]);


            $requeteSupprimeFilm = $pdo->prepare("DELETE FROM film WHERE id_film = :id");
            $requeteSupprimeFilm ->execute(["id"=>$id]);
        }
        require("view/home.php");
    }
    
    
    
    


}


// Pour interpréter les données renvoyées par la requêtes, deux choix s'offrent à nous 
// :On fetch s'il n'y a qu'un seul résultat attendu (une ligne sur HeidiSQL) --> retourne un tableau associatif 
// On fetchAll si un ensemble de résultats est attendu (plusieurs lignes sur HeidiSQL) --> retourne un tableau de tableaux associatifs

// Le fichier CinemaController.php sert à gérer les actions liées aux films et aux acteurs. Contient l'ensemble des requêtes SQL dans les fonctions en relation avec les vues 