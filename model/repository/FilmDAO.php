<?php

namespace Model\repository;

use Model\repository\DAO;
use Model\entity\Film;
use Model\entity\Acteur;
use Model\entity\Role;

class FilmDAO extends Dao
{
    //Récupérer tous les films 
    public static function getAll(): array
    {

        $query = self::$bdd->prepare("SELECT id, titre, realisateur, affichage, annee, role, acteur description FROM film");
        $query->execute();
        $films = array();

        while ($data = $query->fetch()) {
            $offres[] = new Film($data['id'], $data['titre'], $data['realisateur'], $data['affichage'], $data['annee'], $data['role']);
        }
        return ($film);
    }

    //Ajouter un film dans la BD ********************************************************
    // on crée : le film, l'acteur et son rôle
    public static function addOne($data): bool
    {

        $requete = 'INSERT INTO film (titre, realisateur, affichage, annee, role, acteur) VALUES (:titre , :realisateur , :affiachage , :annee, :role, :role)';
        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affichage' => $data->getAffichage(), 'annee' => $data->getAnnee(), 'role' => $data->getRole(), 'acteur' => $data->getActeur()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //Récupérer info sur 1 film
    public static function getOne(int $id): Film
    {
        $query = self::$bdd->prepare("SELECT f.id as film_id, titre, realisateur, affiche, annee, r.id AS role_id, personnage, a.id AS acteur_id, nom, prenom FROM film AS f INNER JOIN role AS r ON f.id = r.id_film INNER JOIN acteur AS a ON r.id_acteur = a.id WHERE film_id = :id_film");
        $query->execute([':id_film' => $id]);

        // Récupération du premier résultat
        $data = $query->fetch();
        return new Film($data['id'], $data['titre'], $data['realisateur'], $data['affichage'], $data['annee'], $data['role'], $data['acteur']);
    }

   
}
