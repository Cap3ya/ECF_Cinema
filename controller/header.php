<?php

use Model\repository\FilmDAO;

$filmDAO = new FilmDAO();

if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    session_destroy();
    unset($_SESSION['user']);
    header("Refresh:0");
}

if (isset($_POST['action']) && $_POST['action'] == 'search') {
    // $films = $filmDAO::getAllLike($_POST['search']);
    $films = [1,2,3];
    echo $twig->render('home.html.twig', [
        'films' => $films,
    ]);    
}

echo $twig->render('header.html.twig');
