<?php

namespace AssureurBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="AssureurBundle\Entity\Rapport", mappedBy="dossier")
     */
    private $rapports;

    /**
     * @ORM\OneToMany(targetEntity="AssureurBundle\Entity\Devis", mappedBy="dossier")
     */
    private $devis;

    /**
    * @ORM\OneToMany(targetEntity="AssureurBundle\Entity\Facture", mappedBy="dossier")
    */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity="AssureurBundle\Entity\Cheque", mappedBy="dossier")
     */
    private $cheques;

    /**
     * @ORM\OneToOne(targetEntity="AssureurBundle\Entity\Constat",inversedBy="Dossier")
     */
    private $constat;

    function __construct()
    {
        $this->rapports = new ArrayCollection();
        $this->devis = new ArrayCollection();
        $this->factures = new ArrayCollection();
        $this->cheques = new ArrayCollection();
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

    /**
     * Set rapports
     *
     * @param \AssureurBundle\Entity\Rapport $rapports
     *
     * @return Dossier
     */
    public function setRapports(\AssureurBundle\Entity\Rapport $rapports = null)
    {
        $this->rapports = $rapports;

        return $this;
    }

    /**
     * Get rapports
     *
     * @return \AssureurBundle\Entity\Rapport
     */
    public function getRapports()
    {
        return $this->rapports;
    }

    /**
     * Set devis
     *
     * @param \AssureurBundle\Entity\Devis $devis
     *
     * @return Dossier
     */
    public function setDevis(\AssureurBundle\Entity\Devis $devis = null)
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * Get devis
     *
     * @return \AssureurBundle\Entity\Devis
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * Set factures
     *
     * @param \AssureurBundle\Entity\Facture $factures
     *
     * @return Dossier
     */
    public function setFactures(\AssureurBundle\Entity\Facture $factures = null)
    {
        $this->factures = $factures;

        return $this;
    }

    /**
     * Get factures
     *
     * @return \AssureurBundle\Entity\Facture
     */
    public function getFactures()
    {
        return $this->factures;
    }

    /**
     * Set cheques
     *
     * @param \AssureurBundle\Entity\Cheque $cheques
     *
     * @return Dossier
     */
    public function setCheques(\AssureurBundle\Entity\Cheque $cheques = null)
    {
        $this->cheques = $cheques;

        return $this;
    }

    /**
     * Get cheques
     *
     * @return \AssureurBundle\Entity\Cheque
     */
    public function getCheques()
    {
        return $this->cheques;
    }

    /**
     * Set accident
     *
     * @param \AssureurBundle\Entity\Accident $accident
     *
     * @return Dossier
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
     * Add rapport
     *
     * @param \AssureurBundle\Entity\Rapport $rapport
     *
     * @return Dossier
     */
    public function addRapport(\AssureurBundle\Entity\Rapport $rapport)
    {
        $this->rapports[] = $rapport;

        return $this;
    }

    /**
     * Remove rapport
     *
     * @param \AssureurBundle\Entity\Rapport $rapport
     */
    public function removeRapport(\AssureurBundle\Entity\Rapport $rapport)
    {
        $this->rapports->removeElement($rapport);
    }

    /**
     * Add devi
     *
     * @param \AssureurBundle\Entity\Devis $devi
     *
     * @return Dossier
     */
    public function addDevi(\AssureurBundle\Entity\Devis $devi)
    {
        $this->devis[] = $devi;

        return $this;
    }

    /**
     * Remove devi
     *
     * @param \AssureurBundle\Entity\Devis $devi
     */
    public function removeDevi(\AssureurBundle\Entity\Devis $devi)
    {
        $this->devis->removeElement($devi);
    }

    /**
     * Add facture
     *
     * @param \AssureurBundle\Entity\Facture $facture
     *
     * @return Dossier
     */
    public function addFacture(\AssureurBundle\Entity\Facture $facture)
    {
        $this->factures[] = $facture;

        return $this;
    }

    /**
     * Remove facture
     *
     * @param \AssureurBundle\Entity\Facture $facture
     */
    public function removeFacture(\AssureurBundle\Entity\Facture $facture)
    {
        $this->factures->removeElement($facture);
    }

    /**
     * Add cheque
     *
     * @param \AssureurBundle\Entity\Cheque $cheque
     *
     * @return Dossier
     */
    public function addCheque(\AssureurBundle\Entity\Cheque $cheque)
    {
        $this->cheques[] = $cheque;

        return $this;
    }

    /**
     * Remove cheque
     *
     * @param \AssureurBundle\Entity\Cheque $cheque
     */
    public function removeCheque(\AssureurBundle\Entity\Cheque $cheque)
    {
        $this->cheques->removeElement($cheque);
    }

    /**
     * Add accident
     *
     * @param \AssureurBundle\Entity\Accident $accident
     *
     * @return Dossier
     */
    public function addAccident(\AssureurBundle\Entity\Accident $accident)
    {
        $this->accidents[] = $accident;

        return $this;
    }

    /**
     * Remove accident
     *
     * @param \AssureurBundle\Entity\Accident $accident
     */
    public function removeAccident(\AssureurBundle\Entity\Accident $accident)
    {
        $this->accidents->removeElement($accident);
    }

    /**
     * Get accidents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccidents()
    {
        return $this->accidents;
    }

    /**
     * Set constat
     *
     * @param \AssureurBundle\Entity\Constat $constat
     *
     * @return Dossier
     */
    public function setConstat(\AssureurBundle\Entity\Constat $constat = null)
    {
        $this->constat = $constat;

        return $this;
    }

    /**
     * Get constat
     *
     * @return \AssureurBundle\Entity\Constat
     */
    public function getConstat()
    {
        return $this->constat;
    }
}
