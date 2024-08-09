<?php

namespace Controller;
use Model\Connect;

class CastingController {

    public function listRoles(){
        $pdo = Connect::seConnecter(); 
        $requeteRole = $pdo->query(" SELECT r.id_role, r.nomPersonnage FROM role r ORDER BY r.nomPersonnage "); 
        $requeteRole->execute();

        require ("view/Casting/listCasting.php"); 
    }

    public function detailRole($id) {
        $pdo = Connect::seConnecter();

        $requeteRole = $pdo->prepare(" SELECT r.id_role, r.nomPersonnage FROM role r WHERE id_role = :id"); 
        $requeteRole->execute(["id" => $id]);
         
        $requeteDetailRole= $pdo->prepare("SELECT a.id_acteur, f.id_film, f.titre, CONCAT(p.nom,' ',p.prenom) AS acteur, r.nomPersonnage FROM film f, casting c, personne p, acteur a, role r WHERE a.id_personne= p.id_personne AND f.id_film = c.id_film AND r.id_role = c.id_role AND c.id_acteur = a.id_acteur AND r.id_role = :id"); 
        $requeteDetailRole->execute(["id" => $id]);

      

        require "view/Casting/detailCasting.php";
       
    }

    public function afficherFormulaireRole() {
        require "view/Casting/ajouterRole.php";
    }

    public function ajouterRole(){
       
            $nomPersonnage = filter_input(INPUT_POST, "nomPersonnage", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if(isset($_POST["submitRole"])){
                $pdo = Connect::seConnecter(); 
                $requeteAjouteRole= $pdo->prepare("INSERT INTO role (nomPersonnage) VALUES ('$nomPersonnage')");
                $requeteAjouteRole->execute();
            
        }
        require("view/home.php");
    }

    public function supprimerRole($id){

        if(isset($_POST["supprimerRole"])){

                $pdo = Connect::seConnecter(); 
                $requeteSupprimerRole = $pdo->prepare("DELETE FROM role WHERE id_role = :id ");
                $requeteSupprimerRole->execute(["id" => $id]);
        }      
        require("view/home.php");
    }

    public function afficherFormulaireCasting() {

        $pdo = Connect::seConnecter();
        $requeteFilm = $pdo->query("SELECT id_film, titre FROM film");

        $requeteActeur = $pdo->query("SELECT a.id_acteur, CONCAT(nom, ' ', prenom) as acteur FROM personne p, acteur a WHERE p.id_personne = a.id_personne");

        $requeteRole = $pdo->query("SELECT r.id_role, r.nomPersonnage FROM role r");



        require "view/Casting/ajouterCasting.php";
    }

    public function ajouterCasting(){

        

            $film= filter_input(INPUT_POST, "film");
            $acteur = filter_input(INPUT_POST, "acteur");
            $role = filter_input(INPUT_POST, "role");

            if(isset($_POST["submitCasting"])){
                $pdo = Connect::seConnecter();

                $requeteAjouteCasting = $pdo->prepare("INSERT INTO casting (id_film, id_acteur, id_role)
                                                        VALUES ('$film', '$acteur', '$role')");


                $requeteAjouteCasting->execute();     
            }
            require("view/home.php");
        }

        public function supprimerCasting($id) {

            if(isset($_POST["supprimerCasting"])){
                $pdo = Connect::seConnecter();
                
                $requeteSupprimeCasting = $pdo->prepare("DELETE FROM casting WHERE id_role = :id");
                $requeteSupprimeCasting->execute(["id" => $id]);
            }
            require("view/home.php");
        }
        



}
