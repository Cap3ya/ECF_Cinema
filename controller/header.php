<?php

if ($_POST['action'] == 'logout') {
    session_destroy();
    unset($_SESSION['user']);
}

echo $twig->render('header.html.twig');
