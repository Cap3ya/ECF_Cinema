<?php

use Model\repository\FilmDAO;

$filmDAO = new FilmDAO();

if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    session_destroy();
    unset($_SESSION['user']);
    header("Location: home");
}

echo $twig->render('header.html.twig');
