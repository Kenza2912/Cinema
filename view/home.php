<?php

ob_start(); ?>

<h2>bonjour</h2>




<?php
$titre = "page d'accueil"; 
$titre_secondaire = "page d'accueil"; 
$contenu = ob_get_clean();



require "template.php";