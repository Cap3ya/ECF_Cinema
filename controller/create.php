<?php

use Model\entity\Film;
use Model\repository\FilmDAO;

$message = null;
$film = null;

if (isset($_POST['titre']) && isset($_POST['realisateur']) && isset($_POST['affichage']) && isset($_POST['annee']) && isset($_POST['roles'])) {

    $film = new Film(0, $_POST['titre'], $_POST['realisateur'], $_POST['affichage'], $_POST['annee'], $_POST['roles']);

    $FilmDao = new FilmDAO();
    $status = $filmDao::addOne($film);
    $message = $status ? "Ajout OK" : "Erreur Ajout";
}
echo $twig->render('creer.html.twig');
