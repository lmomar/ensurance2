<?php

namespace AssureurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accident
 *
 * @ORM\Table(name="accident")
 * @ORM\Entity(repositoryClass="AssureurBundle\Repository\AccidentRepository")
 */
class Accident
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
     * @var int
     *
     * @ORM\Column(name="dossier_id", type="integer")
     */
    private $dossierId;
    
     /**
     * @var int
     *
     * @ORM\Column(name="accident_id", type="integer")
     */
    private $accidentId;

    /**
     * @var float
     *
     * @ORM\Column(name="coord1", type="float")
     */
    private $coord1;

    /**
     * @var float
     *
     * @ORM\Column(name="coord2", type="float")
     */
    private $coord2;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_accident", type="datetimetz")
     */
    private $dateAccident;

    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="string", length=255)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var bool
     *
     * @ORM\Column(name="blesses", type="boolean")
     */
    private $blesses;

    /**
     * @var bool
     *
     * @ORM\Column(name="degat_autre", type="boolean")
     */
    private $degatAutre;

    /**
     * @var string
     *
     * @ORM\Column(name="croquis_url", type="text")
     */
    private $croquisUrl;


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
     * Set dossierId
     *
     * @param integer $dossierId
     *
     * @return Accident
     */
    public function setDossierId($dossierId)
    {
        $this->dossierId = $dossierId;

        return $this;
    }

    /**
     * Get dossierId
     *
     * @return int
     */
    public function getDossierId()
    {
        return $this->dossierId;
    }

    /**
     * Set coord1
     *
     * @param float $coord1
     *
     * @return Accident
     */
    public function setCoord1($coord1)
    {
        $this->coord1 = $coord1;

        return $this;
    }

    /**
     * Get coord1
     *
     * @return float
     */
    public function getCoord1()
    {
        return $this->coord1;
    }

    /**
     * Set coord2
     *
     * @param float $coord2
     *
     * @return Accident
     */
    public function setCoord2($coord2)
    {
        $this->coord2 = $coord2;

        return $this;
    }

    /**
     * Get coord2
     *
     * @return float
     */
    public function getCoord2()
    {
        return $this->coord2;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Accident
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateAccident
     *
     * @param \DateTime $dateAccident
     *
     * @return Accident
     */
    public function setDateAccident($dateAccident)
    {
        $this->dateAccident = $dateAccident;

        return $this;
    }

    /**
     * Get dateAccident
     *
     * @return \DateTime
     */
    public function getDateAccident()
    {
        return $this->dateAccident;
    }

    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return Accident
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Accident
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Accident
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set blesses
     *
     * @param boolean $blesses
     *
     * @return Accident
     */
    public function setBlesses($blesses)
    {
        $this->blesses = $blesses;

        return $this;
    }

    /**
     * Get blesses
     *
     * @return bool
     */
    public function getBlesses()
    {
        return $this->blesses;
    }

    /**
     * Set degatAutre
     *
     * @param boolean $degatAutre
     *
     * @return Accident
     */
    public function setDegatAutre($degatAutre)
    {
        $this->degatAutre = $degatAutre;

        return $this;
    }

    /**
     * Get degatAutre
     *
     * @return bool
     */
    public function getDegatAutre()
    {
        return $this->degatAutre;
    }

    /**
     * Set croquisUrl
     *
     * @param string $croquisUrl
     *
     * @return Accident
     */
    public function setCroquisUrl($croquisUrl)
    {
        $this->croquisUrl = $croquisUrl;

        return $this;
    }

    /**
     * Get croquisUrl
     *
     * @return string
     */
    public function getCroquisUrl()
    {
        return $this->croquisUrl;
    }

    /**
     * Set accidentId
     *
     * @param integer $accidentId
     *
     * @return Accident
     */
    public function setAccidentId($accidentId)
    {
        $this->accidentId = $accidentId;

        return $this;
    }

    /**
     * Get accidentId
     *
     * @return integer
     */
    public function getAccidentId()
    {
        return $this->accidentId;
    }
}
