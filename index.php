<!-- index.php sert à accueillir l'action transmise par l'URL (en GET), il gère les requêtes et dirige les actions vers le controlleur -->


<?php


// On "use" le controller 
use Controller\CinemaController; 
use Controller\GenreController;
use Controller\ActeurController;


// On autocharge les classes du projet
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';

});


// On instancie le controller Cinema
$ctrlCinema =new CinemaController(); 
$ctrlGenre = new GenreController();
$ctrlActeur = new ActeurController();


// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller (on vérifie si l'action est définie dans l'URL)
// Vérification de l'ID
$id = isset($_GET["id"]) ? $_GET["id"] : null;
if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "home" : $ctrlCinema->home(); break;
        case "detailFilm" :
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $ctrlCinema->detailFilm($id); break;
       
             //ACTEUR
        case "listActeurs" : $ctrlActeur->listActeurs(); break;
        case "detailActeur":
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $ctrlActeur->detailActeur($id); break;  
        case "afficherFormulaireActeur" : $ctrlActeur->afficherFormulaireActeur(); break;
        case "ajouterActeur" : $ctrlActeur->ajouterActeur(); break;
        case "supprimerActeur" : $ctrlActeur->supprimerActeur($id); break;
        
             
              //GENRE
        case "listGenres" : $ctrlGenre->listGenres(); break;
        case "detailsGenre" : $ctrlGenre->detailsGenre($id); break;
        case "ajouterGenre" : $ctrlGenre->ajouterGenre(); break;
        case "afficherFormulaireGenre" : $ctrlGenre->afficherFormulaireGenre(); break;
        case "supprimerGenre" : $ctrlGenre->supprimerGenre($id);break;


        default : $ctrlCinema->home(); break;

       
    }
}



