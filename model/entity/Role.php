<?php

namespace Model\entity;

class Role
{

    private $id;
    private $personnage;

    public function __construct($id, $personnage)
    {
        $this->setId($id);
        $this->setpersonnage($personnage);
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
}