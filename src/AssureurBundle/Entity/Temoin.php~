<?php

namespace AssureurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Temoin
 *
 * @ORM\Table(name="temoin")
 * @ORM\Entity(repositoryClass="AssureurBundle\Repository\TemoinRepository")
 */
class Temoin
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;


    /**
     * @var DateTime
     * @ORM\Column(name="created",type="datetime")
     */
    private $created;

    /**
     * @var Boolean
     * @ORM\Column(name="deleted",type="boolean")
     */
    private $deleted;

    /**
     * @ORM\ManyToOne(targetEntity="AssureurBundle\Entity\Accident",inversedBy="temoins")
     * @ORM\JoinColumn(name="accident_id", referencedColumnName="id")
     */
    private $accident;

    function __construct()
    {
        $this->deleted = false;
        $this->created = new \DateTime('now');
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
     * Set tel
     *
     * @param string $tel
     *
     * @return Temoin
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Temoin
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Temoin
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Temoin
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Temoin
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Temoin
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
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Temoin
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
     * Set accident
     *
     * @param \AssureurBundle\Entity\Accident $accident
     *
     * @return Temoin
     */
    public function setAccident(\AssureurBundle\Entity\Accident $accident = null)
    {
        $this->accident = $accident;

        return $this;
    }

    /**
     * Get accident
     *
     * @return \AssureurBundle\Entity\Accident
     */
    public function getAccident()
    {
        return $this->accident;
    }
}
