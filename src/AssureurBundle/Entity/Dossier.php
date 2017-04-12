<?php

namespace AssureurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dossier
 *
 * @ORM\Table(name="dossier")
 * @ORM\Entity(repositoryClass="AssureurBundle\Repository\DossierRepository")
 */
class Dossier
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_ouverture", type="datetimetz")
     */
    private $dateOuverture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fermeture", type="datetimetz")
     */
    private $dateFermeture;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var int
     *
     * @ORM\Column(name="accident_id", type="integer")
     */
    private $accidentId;


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
     * Set dateOuverture
     *
     * @param \DateTime $dateOuverture
     *
     * @return Dossier
     */
    public function setDateOuverture($dateOuverture)
    {
        $this->dateOuverture = $dateOuverture;

        return $this;
    }

    /**
     * Get dateOuverture
     *
     * @return \DateTime
     */
    public function getDateOuverture()
    {
        return $this->dateOuverture;
    }

    /**
     * Set dateFermeture
     *
     * @param \DateTime $dateFermeture
     *
     * @return Dossier
     */
    public function setDateFermeture($dateFermeture)
    {
        $this->dateFermeture = $dateFermeture;

        return $this;
    }

    /**
     * Get dateFermeture
     *
     * @return \DateTime
     */
    public function getDateFermeture()
    {
        return $this->dateFermeture;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Dossier
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set accidentId
     *
     * @param integer $accidentId
     *
     * @return Dossier
     */
    public function setAccidentId($accidentId)
    {
        $this->accidentId = $accidentId;

        return $this;
    }

    /**
     * Get accidentId
     *
     * @return int
     */
    public function getAccidentId()
    {
        return $this->accidentId;
    }
}