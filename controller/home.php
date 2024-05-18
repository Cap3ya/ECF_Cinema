<?php

use Model\repository\FilmDAO;

$filmDAO = new FilmDAO();
$films = [];

if (isset($_POST['action']) && $_POST['action'] == 'search') {
    $films = $filmDAO::getAll($_POST['search']);
} else {
    $films = $filmDAO::getAll("");
}

echo $twig->render('home.html.twig', [
    'films' => $films,
]);