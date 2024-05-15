<?php
<<<<<<< HEAD

require './config/init.php';

require './controller/header.php';

$routes = [
    '/' => './controller/home.php',
    '/home' => './controller/home.php',
    '/creer' => './controller/creer.php',
    '/compte' => './controller/compte.php',
=======
// Creé par Eviougeas le 13/5/2024
// ******************** Controller pricipal ***************************************
// Initialisation de l'environnement
// Load Our autoloader
require './config/init.php';
// ************         Affichage du header  ***************************************
require './controller/header.php';
// ************          Gestion de Routing ***************************************
$routes = [
    '/' => './controller/home.php',
    'home' => './controller/home.php',
    'creerUser' => './controller/creerUser.php',
    'creerFilm' => './controller/creerFilm.php'
>>>>>>> f3e98fd93dbaedf59ddb19fb484e46be0d524c64
];

$controller = $_SERVER['REQUEST_URI'] ?? '/';

if (array_key_exists($controller, $routes)) {
    require $routes[$controller];
} else {
    require 'controller/erreur.php';
}

require './controller/footer.php';