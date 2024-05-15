<?php

namespace Model\entity;

class Role
{

    private $id;
    private $acteur;
    private $personnage;

    public function __construct(
        int $id = null,
        Acteur $acteur, 
        string $personnage
    )
    {
        $this->setId($id);
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
}