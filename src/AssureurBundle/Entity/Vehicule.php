<?php

namespace AssureurBundle\Entity;

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
     * @ORM\Column(name="matricule", type="string", length=10, unique=true)
     */
    private $matricule;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_id", type="integer")
     */
    private $type_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255)
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="num_carte_grise", type="string", length=30)
     */
    
    
    private $numCarteGrise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetimetz")
     */
    private $created;


    /**
     * @ORM\Column(type="integer")
     */
    private $n_contrat_assur;
    
    /**
     * @ORM\Column(type="string")
     */
    private $nom_assurance;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $num_attestation;
    /**
     * @ORM\Column(type="integer")
     */
    private $num_police;
    
    /**
     * @ORM\Column(type="date")
     */
    private $valable_du;
    
    /**
     * @ORM\Column(type="date")
     */
    private $valable_au;
    
    /**
     * @ORM\Column(type="string")
     */
    
    private $ag_bur_court;
    
    public function __construct() {
        $this->created = new \DateTime();
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Vehicule
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
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
     * Set numCarteGrise
     *
     * @param string $numCarteGrise
     *
     * @return Vehicule
     */
    public function setNumCarteGrise($numCarteGrise)
    {
        $this->numCarteGrise = $numCarteGrise;

        return $this;
    }

    /**
     * Get numCarteGrise
     *
     * @return string
     */
    public function getNumCarteGrise()
    {
        return $this->numCarteGrise;
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
        $this->type_id = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
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
     * @param integer $nContratAssur
     *
     * @return Vehicule
     */
    public function setNContratAssur($nContratAssur)
    {
        $this->n_contrat_assur = $nContratAssur;

        return $this;
    }

    /**
     * Get nContratAssur
     *
     * @return integer
     */
    public function getNContratAssur()
    {
        return $this->n_contrat_assur;
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
        $this->nom_assurance = $nomAssurance;

        return $this;
    }

    /**
     * Get nomAssurance
     *
     * @return string
     */
    public function getNomAssurance()
    {
        return $this->nom_assurance;
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
        $this->num_attestation = $numAttestation;

        return $this;
    }

    /**
     * Get numAttestation
     *
     * @return integer
     */
    public function getNumAttestation()
    {
        return $this->num_attestation;
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
        $this->num_police = $numPolice;

        return $this;
    }

    /**
     * Get numPolice
     *
     * @return integer
     */
    public function getNumPolice()
    {
        return $this->num_police;
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
        $this->valable_du = $valableDu;

        return $this;
    }

    /**
     * Get valableDu
     *
     * @return \DateTime
     */
    public function getValableDu()
    {
        return $this->valable_du;
    }

    /**
     * Set valableAu
     *
     * @param \DateTime $valableAu
     *
     * @return Vehicule
     */
    public function setValableAu($valableAu)
    {
        $this->valable_au = $valableAu;

        return $this;
    }

    /**
     * Get valableAu
     *
     * @return \DateTime
     */
    public function getValableAu()
    {
        return $this->valable_au;
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
        $this->ag_bur_court = $agBurCourt;

        return $this;
    }

    /**
     * Get agBurCourt
     *
     * @return string
     */
    public function getAgBurCourt()
    {
        return $this->ag_bur_court;
    }
}
