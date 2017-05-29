<?php

namespace AssureurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity(repositoryClass="AssureurBundle\Repository\FactureRepository")
 */
class Facture
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;



    /**
     * @var datetime
     * @ORM\Column(name="created",type="datetime")
     */
    private $created;

    /**
     * @var Boolean
     * @ORM\Column(name="deleted",type="boolean")
     */
    private $deleted;

    /**
     * @ORM\ManyToOne(targetEntity="AssureurBundle\Entity\Dossier", inversedBy="factures")
     * @ORM\JoinColumn(name="dossier_id", referencedColumnName="id")
     */
    private $dossier;

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
     * Set url
     *
     * @param string $url
     *
     * @return Facture
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    
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
     * @return Facture
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
     * Set dossier
     *
     * @param \AssureurBundle\Entity\Dossier $dossier
     *
     * @return Facture
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
