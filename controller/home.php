<?php

use Model\repository\FilmDAO;

//On appelle la fonction getAll()
$filmDao = new FilmDAO();

$film = $filmDao->getAll();

unset($_SESSION['user']);
// $_SESSION['user'] = 'vince@afpa.com';

//On affiche le template Twig correspondant
echo $twig->render('home.html.twig', ['film' => $film]);
