<?php

require './config/init.php';

require './controller/header.php';

$routes = [
    '/' => './controller/home.php',
    '/home' => './controller/home.php',
    '/creer' => './controller/creer.php',
    '/compte' => './controller/compte.php',
];

$controller = $_SERVER['REQUEST_URI'] ?? '/';

if (array_key_exists($controller, $routes)) {
    require $routes[$controller];
} else {
    require 'controller/erreur.php';
}

require './controller/footer.php';