<?php

namespace Model\entity;


class Film
{

    private $role;
    private $id;
    private $titre;
    private $realisateur;
    private $affiche;
    private $annee;

    public function __construct(int $id,string $titre,string $realisateur,string $affiche,string $annee,Role ...$role,)
    {
        $this->setRole($role);
        $this->setId($id);
        $this->setTitre($titre);
        $this->setRealisateur($realisateur);
        $this->setAffiche($affiche);
        $this->setAnne($annee);
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getRealisateur()
    {
        return $this->realisateur;
    }

    public function setRealisateur($realisateur)
    {
        $this->$realisateur = $realisateur;
    }

    public function getAffiche()
    {
        return $this->affiche;
    }

    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;
    }

    public function getAnne()
    {
        return $this->annee;
    }
    
    public function setAnne($annee)
    {
        $this->annee = $annee;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

}
