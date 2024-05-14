<?php
namespace Model\repository;

use Model\repository\Dao;
use Model\entity\Acteur;
// Creé par Eviougeas le 13/5/2024
class ActeurPDO extends Dao
{    //Récupérer toutes les offres
    public static function getAll(): array
    {
        $query = self::$bdd->prepare("SELECT * FROM acteur");
        $query->execute();
        $acteurs = array();
        while ($data = $query->fetch()) {
            $acteurs[] = new Acteur($data['id'], $data['nom'], $data['prenom']);
        }
        return $acteurs;
    }

    //Ajouter un acteur
    public static function addOne($data): bool
    {
        $requete = 'INSERT INTO acteur (id, nom, prenom) VALUES (:id, :nom, :prenom)';
        $valeurs = ['id' => $data->getId(), 'nom' => $data->getNom(), 'prenom' => $data->getPrenom()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //Récupérer plus d'info sur 1 acteur
    public static function getOne(int $id): Acteur
    {
        $query = self::$bdd->prepare('SELECT * FROM acteur WHERE id = :id');
        $query->execute(array(':id' => $id));
        $data = $query->fetch();
        return new Acteur($data['id'], $data['nom'], $data['prenom']);
    }

}