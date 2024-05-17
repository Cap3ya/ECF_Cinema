<?php

use Model\entity\Film;
use Model\entity\Role;
use Model\entity\Acteur;
use Model\repository\FilmDAO;

$filmDAO = new FilmDAO();

//récupérer les données de la twig pour insertion dans les tables: 1 film, 3 roles et peut être 3 acteurs
if (isset($_POST['titre']) && isset($_POST['realisateur']) && isset($_POST['affiche']) &&
    isset($_POST['annee']) && isset($_POST['acteur_nom']) && isset($_POST['acteur_prenom']) && isset($_POST['personnage'])) {

    //Récupérer Acteurs et Roles
    $roles = [];
    for ($i=0; $i < count($_POST['personnage']) ; $i++) { 
        $acteur = new Acteur(0, $_POST['acteur_nom'][$i], $_POST['acteur_prenom'][$i]);
        $role = new Role(0, $acteur, $_POST['personnage'][$i]);
        $roles[] = $role;
    }

    $film = new Film(0, $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee'], $roles);

    $filmDAO::addOne($film);
}

echo $twig->render('creer.html.twig');
