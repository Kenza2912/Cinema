<?php

namespace Controller;
use Model\Connect;

class RealisateurController {

    // Lister les réalisateurs
    public function listRealisateur(){
        $pdo = Connect::seConnecter(); //On se connecte
        $requeteRealisateur = $pdo->query(" SELECT r.id_realisateur, p.photo, CONCAT(p.nom, ' ', p.prenom) AS realisateur FROM realisateur r LEFT JOIN personne p ON r.id_personne = p.id_personne ORDER BY realisateur"); 
        $requeteRealisateur->execute();
        require ("view/Realisateur/listRealisateur.php"); 
    }


    public function detailRealisateur($id){
        $pdo = Connect::seConnecter();
        $requeteDetailRealisateur = $pdo->prepare("SELECT id_realisateur, p.prenom, p.nom, p.photo, p.sexe, DATE_FORMAT(p.dateNaissance, '%d/%m/%Y') AS dateNaissance FROM realisateur r, personne p WHERE r.id_personne = p.id_personne AND r.id_realisateur = :id");
         $requeteDetailRealisateur->execute(["id" => $id]);

        $requeteFilms = $pdo->prepare("SELECT f.id_film, f.titre, r.id_realisateur
        FROM realisateur r, film f
        WHERE r.id_realisateur = f.id_realisateur
        AND r.id_realisateur = :id");
        $requeteFilms->execute(["id" => $id]);

        require ("view/Realisateur/detailRealisateur.php");
    }

    public function afficherFormulaireRealisateur() {
        require "view/Realisateur/ajouterRealisateur.php";
    }

    //  Fonction d'ajout d'un acteur
    public function ajouterRealisateur() {

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = $_POST['sexe'];
        $dateNaissance = $_POST['dateNaissance'];

        if ($_POST["submitRealisateur"]) {
            
            $pdo = Connect::seConnecter();
           
            $requeteAjoutPersonne = $pdo->prepare("INSERT INTO personne (nom, prenom, sexe, dateNaissance)
                                                    VALUES ('$nom', '$prenom', '$sexe', '$dateNaissance')
            ");
            $requeteAjoutPersonne->execute();

            

            $requeteAjouterRealisateur = $pdo->prepare("INSERT INTO realisateur(id_personne)
                                                    SELECT LAST_INSERT_ID()");
            $requeteAjouterRealisateur ->execute();    
        }
        require "view/home.php";
        
    }

    public function supprimerRealisateur($id){
        if(isset($_POST["supprimerRealisateur"])){
            $pdo = Connect::seConnecter();
           
            $requeteSupprimerRealisateur = $pdo->prepare("DELETE FROM realisateur WHERE id_realisateur = :id");
            $requeteSupprimerRealisateur->execute(["id"=>$id]);

           
        }
        require "view/home.php";
    }








}
