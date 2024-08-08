<?php

namespace Controller;
use Model\Connect;

class ActeurController {

    public function listActeurs() {
        $pdo = Connect::seConnecter(); 
        // On exécute la requête de notre choix
        $requete = $pdo->query("SELECT a.id_acteur, CONCAT(p.nom, ' ', p.prenom) AS acteur FROM acteur a LEFT JOIN personne p ON a.id_personne = p.id_personne"); 
        require "view/Acteur/listActeurs.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }

    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
         
        $requete= $pdo->prepare("SELECT a.id_acteur, p.nom, p.prenom, p.sexe, p.dateNaissance FROM personne p JOIN acteur a ON p.id_personne = a.id_personne WHERE a.id_acteur = :id"); 
        $requete->execute(["id" => $id]);

        $requeteFilms = $pdo->prepare("SELECT f.id_film, f.titre, a.id_acteur FROM acteur a, film f, casting c, personne p WHERE a.id_acteur = c.id_acteur AND p.id_personne = a.id_personne AND c.id_film = f.id_film AND a.id_acteur = :id");
        $requeteFilms->execute(["id" => $id]);

        require "view/Acteur/detailActeur.php";
       
    }

    public function afficherFormulaireActeur() {
        require "view/Acteur/ajouterActeur.php";
    }

   
        
     //  Fonction d'ajout d'un acteur
    public function ajouterActeur() {

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = $_POST['sexe'];
        $dateNaissance = $_POST['dateNaissance'];

        if ($_POST["submitActeur"]) {
            
            $pdo = Connect::seConnecter();
           
            $requeteAjoutPersonne = $pdo->prepare("INSERT INTO personne (nom, prenom, sexe, dateNaissance)
                                                    VALUES ('$nom', '$prenom', '$sexe', '$dateNaissance')
            ");
            $requeteAjoutPersonne->execute();

            

            $requeteAjouterActeur = $pdo->prepare("INSERT INTO acteur(id_personne)
                                                    SELECT LAST_INSERT_ID()");
            $requeteAjouterActeur ->execute();    
        }
        require "view/home.php";
        
    }

    public function supprimerActeur($id){
        if(isset($_POST["supprimerActeur"])){
            $pdo = Connect::seConnecter();
           
            $requeteSupprimerActeur = $pdo->prepare("DELETE FROM acteur WHERE id_acteur = :id");
            $requeteSupprimerActeur->execute(["id"=>$id]);

           
        }
        require "view/home.php";
    }

            

}
