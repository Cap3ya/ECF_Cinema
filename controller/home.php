<?php

use Model\repository\FilmDAO;

$filmDAO = new FilmDAO();
$films = [];

if (isset($_POST['action']) && $_POST['action'] == 'search') {
    // $filmDAO::getAllLike($_POST['search']);
    $films[] = $_POST['search'];
} else {
    $films = $filmDAO::getAll();
}

var_dump($films);

echo $twig->render('home.html.twig', [
    'films' => $films,
]);