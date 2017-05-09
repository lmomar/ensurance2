<?php

namespace ApiUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permis
 *
 * @ORM\Table(name="permis")
 * @ORM\Entity(repositoryClass="ApiUserBundle\Repository\PermisRepository")
 */
class Permis
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
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_delivre", type="date")
     */
    private $dateDelivre;

    /**
     * @var string
     *
     * @ORM\Column(name="prefecture", type="string", length=255)
     */
    private $prefecture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="ApiUserBundle\Entity\User", inversedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    public function __construct() {
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Permis
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
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Permis
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set dateDelivrePermis
     *
     * @param \DateTime $dateDelivrePermis
     *
     * @return Permis
     */
    public function setDateDelivre($dateDelivre)
    {
        $this->dateDelivre = $dateDelivre;

        return $this;
    }

    /**
     * Get dateDelivrePermis
     *
     * @return \DateTime
     */
    public function getDateDelivre()
    {
        return $this->dateDelivre;
    }

    /**
     * Set prefecture
     *
     * @param string $prefecture
     *
     * @return Permis
     */
    public function setPrefecture($prefecture)
    {
        $this->prefecture = $prefecture;

        return $this;
    }

    /**
     * Get prefecture
     *
     * @return string
     */
    public function getPrefecture()
    {
        return $this->prefecture;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Permis
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
     * Set user
     *
     * @param \ApiUserBundle\Entity\User $user
     *
     * @return Permis
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
}
