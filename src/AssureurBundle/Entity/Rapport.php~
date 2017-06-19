<?php

namespace AssureurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rapport
 *
 * @ORM\Table(name="rapport")
 * @ORM\Entity(repositoryClass="AssureurBundle\Repository\RapportRepository")
 */
class Rapport
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
    * @ORM\Column(name="created",type="datetime")
    */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="ApiUserBundle\Entity\User",inversedBy="rapports",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AssureurBundle\Entity\Dossier",inversedBy="rapports",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="dossier_id",referencedColumnName="id")
     */
    private $dossier;


    public function __construct(){
     $this->created = new \DateTime('now')   ;
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Rapport
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
     * @return Rapport
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
     * Set dossier
     *
     * @param \AssureurBundle\Entity\Dossier $dossier
     *
     * @return Rapport
     */
    public function setDossier(\AssureurBundle\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \AssureurBundle\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }
}
