<?php
// Creé par Eviougeas le 13/5/2024
namespace Model\entity;
class Acteur
{
    private $id;
    private $nom;
    private $prenom;

    public function __construct(
        int $id,
        string $nom,
        string $prenom
    ) {
        $this->setId($id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
    }

    /**
     * Get la valeur de  id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set la valeur de  id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get la valeur de  nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set la valeur de  nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get la valeur de  prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set la valeur de  prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }


}
