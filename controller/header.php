<?php

use Model\repository\FilmDAO;

$filmDAO = new FilmDAO();

if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    session_destroy();
    unset($_SESSION['user']);
    header("Refresh:0");
}

echo $twig->render('header.html.twig');
