<!-- index.php sert à accueillir l'action transmise par l'URL (en GET), il gère les requêtes et dirige les actions vers le controlleur -->


<?php


// On "use" le controller Cinema
use Controller\CinemaController; 


// On autocharge les classes du projet
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';

});


// On instancie le controller Cinema
$ctrlCinema =new CinemaController(); 


// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller (on vérifie si l'action est définie dans l'URL)
// Vérification de l'ID
$id = isset($_GET["id"]) ? $_GET["id"] : null;
if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "home" : $ctrlCinema->home(); break;
        case "detailFilm" :
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $ctrlCinema->detailFilm($id); break;
        case "detailActeur":
             $id = isset($_GET['id']) ? $_GET['id'] : null;
             $ctrlCinema->detailActeur($id); break;    
        default : $ctrlCinema->home(); break;

       
    }
}



