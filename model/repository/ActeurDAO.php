<?php

namespace Model\repository;

use Model\entity\Acteur;
// Creé par Eviougeas le 13/5/2024
class ActeurPDO extends Dao

{ //Récupérer tous les acteurs
    public static function getAll(): array
    {
        $query = self::$bdd->prepare("SELECT * FROM acteur");
        $query->execute();
        $acteurs = [];

        while ($data = $query->fetch()) {
            $acteurs[] = new Acteur($data['id'], $data['nom'], $data['prenom']);
        }
        return $acteurs;
    }

    //Ajouter un acteur
    public static function addOne($data): bool
    {
        $query = 'INSERT INTO acteur (nom, prenom) VALUES ( :nom, :prenom)';
        $valeurs = ['nom' => $data->getNom(), 'prenom' => $data->getPrenom()];
        $insert = self::$bdd->prepare($query);
        return $insert->execute($valeurs);
    }

    //Récupérer l'info sur 1 acteur à partir de son id
    public static function getOne(int $id): ?Acteur
    {
        $query = self::$bdd->prepare('SELECT * FROM acteur WHERE id = :id');
        $query->execute([':id' => $id]);
        $data = $query->fetch();
        return  $data ? new Acteur($data['id'], $data['nom'], $data['prenom']) : null;
    }

    //Récupérer l'info sur 1 acteur à partir de son nom et prénom
    public static function getOneFromNomPrenom(string $nom, string $prenom): ?Acteur
    {
        // Convertir les noms et prénoms en minuscules pour comparer de manière insensible à la casse
        $nom = strtolower($nom);
        $prenom = strtolower($prenom);

        $query = self::$bdd->prepare('SELECT * FROM acteur WHERE LOWER(nom) = :nom and LOWER(prenom) = :prenom');
        $valeurs = ['nom' => $nom, 'prenom' => $prenom];
        $query->execute($valeurs);
        $data = $query->fetch();
        return $data ? new Acteur($data['id'], $data['nom'], $data['prenom']) :  null;
    }
}
