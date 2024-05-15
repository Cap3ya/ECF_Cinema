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
        $query = self::$bdd->prepare("SELECT f.id, titre, realisateur, affiche, annee, r.personnage, a.nom, a.prenom FROM film as f INNER JOIN role as r ON f.id = r.id_film INNER JOIN acteur as A ON r.id_acteur = a.id");
        $query->execute();
        $films = array();

        while ($data = $query->fetch()) {
            $films[] = new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee'], $data['role']);
        }
        return ($films);
    }

    //Ajouter un film dans la BD ********************************************************
    // on crée : le film, l'acteur et son rôle
    public static function addOne($data): bool
    {
        $requete = 'INSERT INTO film (titre, realisateur, affiche, annee) VALUES (:titre , :realisateur , :affiche, :annee)';
        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //Ajouter un Role à un film
    public static function addRole($data): bool
    {
        $requete = 'INSERT INTO role (personnage, id_film, id_acteur) VALUES (:personnage, :id_film, :id_acteur)';
        $valeurs = ['personnage' => $data->getPersonnage(), 'id_film' => $data->getIdFilm(), 'acteur' => $data->getActeur()];
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
        if ($data) {
            $film = new Film($data['film_id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);

        // Création de la première instance de Role
        $role = new Role($data['role_id'],$data['film_id'], new Acteur($data['acteur_id'], $data['nom'], $data['prenom']), $data['personnage'] );

        $film->addRole($role);
        while ($data = $query->fetch()) {
            // Créer une instance de Role
            $role = new Role($data['role_id'], $$data['film_id'], new Acteur($data['acteur_id'], $data['nom'], $data['prenom']), $data['personnage']);

            // On ajoutez le rôle à l'instance de film 
            $film->addRole($role);
        }

		}
        return  $film ?? null;		
	}
}