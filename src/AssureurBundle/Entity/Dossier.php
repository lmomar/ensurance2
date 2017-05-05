<?php

namespace AssureurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @var \Date
     *
     * @ORM\Column(name="date_ouverture", type="datetime")
     * @Assert\DateTime()
     */
    private $dateOuverture;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_fermeture", type="datetime",nullable=true)
     */
    private $dateFermeture;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     * @Assert\Length(min=5,minMessage="Veuillez remplir ce champ statut")
     */
    private $statut;

    /**
     * @var integer
     * @ORM\Column(name="accident_id",type="integer")
     * @Assert\Range(min="1",max="9000",minMessage="entre 1 et 9000")
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
     * Set dossierId
     *
     * @param integer $accidentId
     *
     * @return accidentId
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
