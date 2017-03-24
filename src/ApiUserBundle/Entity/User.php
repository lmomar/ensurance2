<?php

namespace ApiUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser  {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $phone;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     */
    protected $date_naissance;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     */
    protected $date_driver_license;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance($dateNaissance) {
        $this->date_naissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance() {
        return $this->date_naissance;
    }

    /**
     * Set dateDriverLicense
     *
     * @param \DateTime $dateDriverLicense
     *
     * @return User
     */
    public function setDateDriverLicense($dateDriverLicense) {
        $this->date_driver_license = $dateDriverLicense;

        return $this;
    }

    /**
     * Get dateDriverLicense
     *
     * @return \DateTime
     */
    public function getDateDriverLicense() {
        return $this->date_driver_license;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

}
