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
     * @ORM\Column(name="created", type="datetimetz")
     */
    private $created;

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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Accident
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
}

