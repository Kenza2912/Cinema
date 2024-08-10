<?php

namespace Controller;
use Model\Connect;

class ActeurController {

    public function listActeurs() {
        $pdo = Connect::seConnecter(); 
        // On exécute la requête de notre choix
        $requete = $pdo->query("SELECT a.id_acteur, p.photo, CONCAT(p.nom, ' ', p.prenom) AS acteur FROM acteur a LEFT JOIN personne p ON a.id_personne = p.id_personne"); 
        require "view/Acteur/listActeurs.php";
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
    }

    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
         
        $requete= $pdo->prepare("SELECT a.id_acteur, p.nom, p.prenom, p.sexe, p.dateNaissance, p.photo FROM personne p JOIN acteur a ON p.id_personne = a.id_personne WHERE a.id_acteur = :id"); 
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
        $pdo = Connect::seConnecter();
    
        if (isset($_POST["submitActeur"])) {
    
            if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {
                // Processus d'upload de l'image
                $tmpName = $_FILES["photo"]["tmp_name"];
                $name = $_FILES["photo"]["name"];
                $size = $_FILES["photo"]["size"];
                $tabExtension = explode(".", $name);
                $extension = strtolower(end($tabExtension));
                $extensions = ["jpg", "png", "jpeg"];
                $maxTaille = 4000000;
    
                if (in_array($extension, $extensions) && $size <= $maxTaille) {
                    $uniqueName = uniqid("", true);
                    $fileUnique = $uniqueName . "." . $extension;
                    move_uploaded_file($tmpName, "./public/imagePersonne/" . $fileUnique);
                    $afficheChemin = "./public/imagePersonne/" . $fileUnique;
                } else {
                    echo "L'image doit être au format JPG, PNG ou JPEG et ne doit pas dépasser 4MB.";
                    return;
                }
            } else {
                if ($_FILES["photo"]["error"] !== 0) {
                    echo "Erreur lors de l'upload de l'image. Code d'erreur : " . $_FILES["photo"]["error"];
                } else {
                    echo "Aucune image n'a été uploadée.";
                }
                return;
            }
    
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Requête pour insérer les informations dans la table `personne`
            $requeteAjoutPersonne = $pdo->prepare("INSERT INTO personne (nom, prenom, sexe, dateNaissance, photo) 
                                                    VALUES (:nom, :prenom, :sexe, :dateNaissance, :photo)");
            // $requeteAjoutPersonne->bindParam(':nom', $nom);
            // $requeteAjoutPersonne->bindParam(':prenom', $prenom);
            // $requeteAjoutPersonne->bindParam(':sexe', $sexe);
            // $requeteAjoutPersonne->bindParam(':dateNaissance', $dateNaissance);
            // $requeteAjoutPersonne->bindParam(':photo', $afficheChemin);
       
            $requeteAjoutPersonne->execute([
                'nom' => $nom,
                "prenom" => $prenom,
                "sexe" => $sexe,
                "dateNaissance" => $dateNaissance,
                "photo" => $afficheChemin
            ]);
         
    
            // Requête pour insérer l'acteur dans la table `acteur`
            $requeteAjouterActeur = $pdo->prepare("INSERT INTO acteur(id_personne) SELECT LAST_INSERT_ID()");
            $requeteAjouterActeur->execute();
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
