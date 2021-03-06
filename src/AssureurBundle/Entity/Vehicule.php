<?php

namespace AssureurBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity(repositoryClass="AssureurBundle\Repository\VehiculeRepository")
 */
class Vehicule
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=255, unique=true)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255)
     */
    private $modele;

    /**
     * @var int
     *
     * @ORM\Column(name="type_id", type="integer")
     */
    private $typeId;
    /**
     * @var string
     *
     * @ORM\Column(name="n_contrat_assur", type="string", length=255)
     */
    private $nContratAssur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_assurance", type="string", length=255)
     */
    private $nomAssurance;

    /**
     * @var int
     *
     * @ORM\Column(name="num_attestation", type="integer")
     */
    private $numAttestation;

    /**
     * @var int
     *
     * @ORM\Column(name="num_police", type="integer")
     */
    private $numPolice;

    /**
     * @var \Date
     *
     * @ORM\Column(name="valable_du", type="datetime")
     */
    private $valableDu;

    /**
     * @var \Date
     *
     * @ORM\Column(name="valable_au", type="datetime")
     */
    private $valableAu;

    /**
     * @var string
     *
     * @ORM\Column(name="ag_bur_court", type="string", length=255)
     */
    private $agBurCourt;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
    * @ORM\Column(name="deleted",type="boolean")
    */
    private $deleted;

    /**
     * @ORM\ManyToOne(targetEntity="ApiUserBundle\Entity\User",inversedBy="vehicules",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\ManyToMany(targetEntity="AssureurBundle\Entity\Accident",mappedBy="vehicules",fetch="EXTRA_LAZY")
     */
    private $accidents;


    public function __construct() {
        $this->deleted=false;
        $this->created = new \DateTime;

    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Vehicule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Vehicule
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Vehicule
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set nContratAssur
     *
     * @param string $nContratAssur
     *
     * @return Vehicule
     */
    public function setNContratAssur($nContratAssur)
    {
        $this->nContratAssur = $nContratAssur;

        return $this;
    }

    /**
     * Get nContratAssur
     *
     * @return string
     */
    public function getNContratAssur()
    {
        return $this->nContratAssur;
    }

    /**
     * Set nomAssurance
     *
     * @param string $nomAssurance
     *
     * @return Vehicule
     */
    public function setNomAssurance($nomAssurance)
    {
        $this->nomAssurance = $nomAssurance;

        return $this;
    }

    /**
     * Get nomAssurance
     *
     * @return string
     */
    public function getNomAssurance()
    {
        return $this->nomAssurance;
    }

    /**
     * Set numAttestation
     *
     * @param integer $numAttestation
     *
     * @return Vehicule
     */
    public function setNumAttestation($numAttestation)
    {
        $this->numAttestation = $numAttestation;

        return $this;
    }

    /**
     * Get numAttestation
     *
     * @return int
     */
    public function getNumAttestation()
    {
        return $this->numAttestation;
    }

    /**
     * Set numPolice
     *
     * @param integer $numPolice
     *
     * @return Vehicule
     */
    public function setNumPolice($numPolice)
    {
        $this->numPolice = $numPolice;

        return $this;
    }

    /**
     * Get numPolice
     *
     * @return int
     */
    public function getNumPolice()
    {
        return $this->numPolice;
    }

    /**
     * Set valableDu
     *
     * @param \DateTime $valableDu
     *
     * @return Vehicule
     */
    public function setValableDu($valableDu)
    {
        $this->valableDu = $valableDu;

        return $this;
    }

    /**
     * Get valableDu
     *
     * @return \DateTime
     */
    public function getValableDu()
    {
        return $this->valableDu;
    }

    /**
     * Set valableAu
     *
     * @param \Date $valableAu
     *
     * @return Vehicule
     */
    public function setValableAu($valableAu)
    {
        $this->valableAu = $valableAu;

        return $this;
    }

    /**
     * Get valableAu
     *
     * @return \Date
     */
    public function getValableAu()
    {
        return $this->valableAu;
    }

    /**
     * Set agBurCourt
     *
     * @param string $agBurCourt
     *
     * @return Vehicule
     */
    public function setAgBurCourt($agBurCourt)
    {
        $this->agBurCourt = $agBurCourt;

        return $this;
    }

    /**
     * Get agBurCourt
     *
     * @return string
     */
    public function getAgBurCourt()
    {
        return $this->agBurCourt;
    }



    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Vehicule
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set typeId
     *
     * @param integer $typeId
     *
     * @return Vehicule
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return int
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Vehicule
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set user
     *
     * @param \ApiUserBundle\Entity\User $user
     *
     * @return Vehicule
     */
    public function setUser(\ApiUserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ApiUserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }



    /**
     * Add accident
     *
     * @param \AssureurBundle\Entity\Accident $accident
     *
     * @return Vehicule
     */
    public function addAccident(\AssureurBundle\Entity\Accident $accident)
    {
        $this->accidents[] = $accident;

        return $this;
    }

    /**
     * Remove accident
     *
     * @param \AssureurBundle\Entity\Accident $accident
     */
    public function removeAccident(\AssureurBundle\Entity\Accident $accident)
    {
        $this->accidents->removeElement($accident);
    }

    /**
     * Get accidents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccidents()
    {
        return $this->accidents;
    }
}
