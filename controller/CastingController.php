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
        require "view/Casting/ajouterCasting.php";
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
        require("view/home.php");;
    }


}
