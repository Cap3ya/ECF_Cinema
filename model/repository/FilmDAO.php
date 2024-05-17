<?php

namespace Model\repository;

use Model\repository\Dao;
use Model\entity\Film;
use Model\entity\Acteur;
use Model\entity\Role;

class FilmDAO extends Dao
{
    public static function addOne($data): bool
    {
        $id_film = 0;
        $id_acteur = 0;

        // Crééer nouveau film
        $insert = self::$bdd->prepare('INSERT INTO film (titre, realisateur, affiche, annee) VALUES (:titre , :realisateur , :affiche, :annee)');
        $insert->execute(['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()]);
        // Get the ID of the last inserted record
        $id_film = self::$bdd->lastInsertId();

        // crééer nouveau roles
        $roles = $data->getRoles();

        foreach ($roles as $key => $role) {
            // check si acteur exist
            list($acteur_nom, $acteur_prenom) = [$role->getActeur()->getNom(), $role->getActeur()->getPrenom()];
            $stmt = self::$bdd->prepare('SELECT EXISTS(SELECT 1 FROM acteur WHERE nom = :nom AND prenom = :prenom)');
            $stmt->execute(['nom' => $acteur_nom, 'prenom' => $acteur_prenom]);
            // si acteur n'existe pas
            if ($stmt->fetchColumn() == 0) {
                // crééer nouvel acteur
                $insert = self::$bdd->prepare('INSERT INTO acteur (nom, prenom) VALUES (:nom , :prenom)');
                $insert->execute(['nom' => $acteur_nom, 'prenom' => $acteur_prenom]);
            }
            // get id_acteur
            $insert = self::$bdd->prepare('SELECT id FROM acteur WHERE nom = :nom AND prenom = :prenom');
            $insert->execute(['nom' => $acteur_nom, 'prenom' => $acteur_prenom]);
            $id_acteur = $insert->fetch()['id'];
            // sinon add new acteur
            // add role
            $insert = self::$bdd->prepare("INSERT INTO role (id_film, id_acteur, personnage) VALUES (:id_film, :id_acteur, :personnage)");
            $insert->execute(['id_film' => $id_film, 'id_acteur' => $id_acteur, 'personnage' => $role->getPersonnage()]);
        }

        return true;
    }

    public static function getAll($search): array
    {
        $getfilms = self::$bdd->prepare("SELECT * FROM film WHERE titre LIKE :search");
        $searchPattern = "%" . $search . "%";
        $getfilms->execute(['search' => $searchPattern ]);

        $films = [];
        while ($film = $getfilms->fetch()) {
            //get roles
            $getRoles = self::$bdd->prepare("SELECT * FROM role WHERE id_film = :id");
            $getRoles->execute([':id' => $film['id']]);

            $roles = [];
            while ($role = $getRoles->fetch()) {
                //get acteurs
                $getActeur = self::$bdd->prepare("SELECT * FROM acteur WHERE id = :id_acteur");
                $getActeur->execute(['id_acteur' => $role['id_acteur']]);
                $acteur = $getActeur->fetch();

                $roles[] = new Role($role['role_id'], new Acteur($acteur['id'], $acteur['nom'], $acteur['prenom']), $role['personnage']);
            }

            $films[] = new Film($film['id'], $film['titre'], $film['realisateur'], $film['affiche'], $film['annee'], $roles); 
        }

        return  $films;
    }

    //Ajouter un Role à un film
    // public static function addRole($data): bool
    // {
    //     $requete = "INSERT INTO role (id_film, id_acteur, personnage) VALUES (:id_film, :id_acteur, :personnage)";
    //     $valeurs = ['id_film' => $data->getIdFilm(), 'acteur' => $data->getIdActeur(), 'personnage' => $data->getPersonnage()];
    //     $insert = self::$bdd->prepare($requete);
    //     return $insert->execute($valeurs);
    // }

    // //Récupérer info sur 1 film
    // public static function getOne(int $id): Film
    // {
    //     $query = self::$bdd->prepare("SELECT f.id as film_id, titre, realisateur, affiche, annee, r.id AS role_id, personnage, a.id AS acteur_id, nom, prenom FROM film AS f INNER JOIN role AS r ON f.id = r.id_film INNER JOIN acteur AS a ON r.id_acteur = a.id WHERE film_id = :id_film");
    //     $query->execute([':id_film' => $id]);

    //     // Récupération du premier résultat
    //     $data = $query->fetch();
    //     if ($data) {
    //         $film = new Film($data['film_id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);

    //         // Création de la première instance de Role
    //         $role = new Role($data['role_id'],  new Acteur($data['acteur_id'], $data['nom'], $data['prenom']), $data['personnage']);

    //         $film->setRoles($role);
    //         while ($data = $query->fetch()) {
    //             // Créer une instance de Role
    //             $role = new Role($data['role_id'], new Acteur($data['acteur_id'], $data['nom'], $data['prenom']), $data['personnage']);

    //             // On ajoutez le rôle à l'instance de film 
    //             $film->setRoles($role);
    //         }
    //     }
    //     return  $film ?? null;
    // }
}
