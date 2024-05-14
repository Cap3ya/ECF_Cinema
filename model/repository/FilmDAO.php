<?php

namespace Model\repository;

use Model\entity\Film;
use Model\repository\DAO;

class FilmDAO extends Dao
{

    //Récupérer toutes les offres
    public static function getAll(): array
    {

        $query = self::$bdd->prepare("SELECT id, titre, realisateur, affichage, annee, role, acteur description FROM film");
        $query->execute();
        $film = array();

        while ($data = $query->fetch()) {
            $offres[] = new Film($data['id'], $data['titre'], $data['realisateur'], $data['affichage'], $data['annee'], $data['role']);
        }
        return ($film);
    }

    //Ajouter une offre
    public static function addOne($data): bool
    {

        $requete = 'INSERT INTO film (titre, realisateur, affichage, annee, role, acteur) VALUES (:titre , :realisateur , :affiachage , :annee, :role, :role)';
        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affichage' => $data->getAffichage(), 'annee' => $data->getAnnee(), 'role' => $data->getRole(), 'acteur' => $data->getActeur()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //Récupérer plus d'info sur 1 offre
    public static function getOne(int $id): Film
    {
        $query = self::$bdd->prepare('SELECT * FROM film WHERE id = :id_film');
        $query->execute(array(':id_film' => $id));
        $data = $query->fetch();
        return new Film($data['id'], $data['titre'], $data['realisateur'], $data['affichage'], $data['annee'], $data['role'], $data['acteur']);
    }

   
}
