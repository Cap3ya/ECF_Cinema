<?php

namespace Model\repository;

use Model\entity\Offre;
use Model\repository\Dao;

class OffreDAO extends Dao
{

    //Récupérer toutes les offres
    public static function getAll(): array
    {

        $query = self::$bdd->prepare("SELECT id, title, description FROM offers");
        $query->execute();
        $offres = array();

        while ($data = $query->fetch()) {
            $offres[] = new Offre($data['id'], $data['title'], $data['description']);
        }
        return ($offres);
    }

    //Ajouter une offre
    public static function addOne($data): bool
    {

        $requete = 'INSERT INTO offers (title, description) VALUES (:title , :description)';
        $valeurs = ['title' => $data->getTitle(), 'description' => $data->getDescription()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //Récupérer plus d'info sur 1 offre
    public static function getOne(int $id): Offre
    {
        $query = self::$bdd->prepare('SELECT * FROM offers WHERE id = :id_offre');
        $query->execute(array(':id_offre' => $id));
        $data = $query->fetch();
        return new Offre($data['id'], $data['title'], $data['description']);
    }

    //Deleter 1 offre par son id
    public static function deleteOne(int $id): bool
    {
        $query = self::$bdd->prepare('DELETE FROM offers WHERE offers.id = :idOffer');
        $query->execute(array(':idOffer' => $id));
        return $query->rowCount() == 1 ? true : false;
    }

    //Ajouter une offre
    public static function updateOne($data): bool
    {
        $requete = 'UPDATE offers set title=:title, description=:description WHERE id=:id';
        $valeurs = ['id' => $data->getId(), 'title' => $data->getTitle(), 'description' => $data->getDescription()];
        $query = self::$bdd->prepare($requete);
        $query->execute($valeurs);
        return $query->rowCount() == 1 ? true : false;
    }
}
