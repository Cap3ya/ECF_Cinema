<?php

use Model\repository\FilmDAO;

$filmDAO = new FilmDAO();
$films = [];

if (isset($_POST['action']) && $_POST['action'] == 'search') {
    $filmDAO::getAll($_POST['search']);
} else {
    $films = $filmDAO::getAll("");
}

var_dump($films);

echo $twig->render('home.html.twig', [
    'films' => $films,
]);