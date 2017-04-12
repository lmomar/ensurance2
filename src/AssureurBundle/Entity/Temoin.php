<?php

namespace AssureurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="nom_assure", type="string", length=255)
     */
    private $nomAssure;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_temoin", type="string", length=255)
     */
    private $prenomTemoin;

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
     * Set nomAssure
     *
     * @param string $nomAssure
     *
     * @return Temoin
     */
    public function setNomAssure($nomAssure)
    {
        $this->nomAssure = $nomAssure;

        return $this;
    }

    /**
     * Get nomAssure
     *
     * @return string
     */
    public function getNomAssure()
    {
        return $this->nomAssure;
    }

    /**
     * Set prenomTemoin
     *
     * @param string $prenomTemoin
     *
     * @return Temoin
     */
    public function setPrenomTemoin($prenomTemoin)
    {
        $this->prenomTemoin = $prenomTemoin;

        return $this;
    }

    /**
     * Get prenomTemoin
     *
     * @return string
     */
    public function getPrenomTemoin()
    {
        return $this->prenomTemoin;
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
     * Set accidentId
     *
     * @param integer $accidentId
     *
     * @return Temoin
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