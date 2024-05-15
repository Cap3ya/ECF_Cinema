<?php

namespace Model\entity;

class Role
{

    private $id;
    private $id_film;
    private $acteur;
    private $personnage;

    public function __construct(
        int $id = null,
        int $id_film,
        Acteur $acteur, 
        string $personnage
    )
    {
        $this->setId($id);
        $this->setId_film($id_film);
        $this->setActeur($acteur);
        $this->setPersonnage($personnage);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPersonnage($personnage)
    {
        $this->personnage = $personnage;
    }

    public function getPersonnage()
    {
        return $this->personnage;
    }

    public function setActeur($acteur)
    {
        $this->acteur = $acteur;
    }

    public function getActeur()
    {
        return $this->acteur;
    }

    /**
     * Get the value of id_film
     */ 
    public function getId_film()
    {
        return $this->id_film;
    }

    /**
     * Set the value of id_film
     *
     * @return  self
     */ 
    public function setId_film($id_film)
    {
        $this->id_film = $id_film;
    }
}