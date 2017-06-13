<?php

namespace AssureurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AssureurBundle\Repository\PhotoRepository")
 */
class Photo {

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
     * @var string
     * @ORM\Column(name="type",type="string")
     */
    private $type;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetimetz")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="AssureurBundle\Entity\Accident", inversedBy="photos")
     * @ORM\JoinColumn(name="accident_id", referencedColumnName="id")
     */
    private $accident;

    public function __construct() {
        $this->created = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Photo
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Photo
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    



    /**
     * Set accident
     *
     * @param \AssureurBundle\Entity\Accident $accident
     *
     * @return Photo
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

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Photo
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
