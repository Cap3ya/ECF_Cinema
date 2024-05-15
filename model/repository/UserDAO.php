<?php

namespace Model\repository;

use Model\entity\User;
use Model\repository\Dao;

class UserDAO extends Dao
{
    //Ajouter un user
    public static function addOne(User $data): bool
    {
        $requete = 'INSERT INTO user (username, email, password) VALUES (:username , :email, :password)';
        $valeurs = ['username' => $data->getUsername(), 'email' => $data->getEmail(), 'password' => $data->getPassword()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //Récupérer un user
    public static function getOne(int $id): User
    {
        $query = self::$bdd->prepare('SELECT * FROM user WHERE id = :userID');
        $query->execute(array(':userID' => $id));
        $data = $query->fetch();
        return new User($data['id'], $data['username'], $data['email'], $data['password']);
    }

    //Récupérer un user via son email
    public static function getOneByEmail(string $email): User
    {
        $query = self::$bdd->prepare('SELECT * FROM user WHERE email = :email');
        $query->execute(array(':email' => $email));
        $data = $query->fetch();
        return new User($data['id'], $data['username'], $data['email'], $data['password']);
    }

    //Récupérer tous les users
    public static function getAll(): array
    {
        $query = self::$bdd->prepare("SELECT * FROM user");
        $query->execute();
        $users = array();

        while ($data = $query->fetch()) {
            $users[] = new User($data['id'], $data['username'], $data['email'], $data['password']);
        }
        return ($users);
    }

    // Test si user existe déjà
    public static function userByEmailExist(string $email)
    {
        $sql = "SELECT EXISTS(SELECT 1 FROM user WHERE email = :email)";
        $stmt = self::$bdd->prepare($sql);
        $stmt->execute(array('email' => $email));
        return $stmt->fetchColumn() == 1;
    }

    // //Delete 1 offre par son id
    // public static function deleteOne(int $id): bool
    // {
    //     $query = self::$bdd->prepare('DELETE FROM offers WHERE offers.id = :idOffer');
    //     $query->execute(array(':idOffer' => $id));
    //     return $query->rowCount() == 1 ? true : false;
    // }

    // //Ajouter une offre
    // public static function updateOne($data): bool
    // {
    //     $requete = 'UPDATE offers set title=:title, description=:description WHERE id=:id';
    //     $valeurs = ['id' => $data->getId(), 'title' => $data->getTitle(), 'description' => $data->getDescription()];
    //     $query = self::$bdd->prepare($requete);
    //     $query->execute($valeurs);
    //     return $query->rowCount() == 1 ? true : false;
    // }
}
