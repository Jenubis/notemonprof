<?php

namespace Notemonprof\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity
 */
class Cours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="abrv", type="text", nullable=false)
     */
    private $abrv;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="text", nullable=false)
     */
    private $intitule;

    /**
     * @ORM\ManyToOne(targetEntity="Notemonprof\UserBundle\Entity\User")
     */
    protected $user;

    /**
     * @ORM\ManytoMany(targetEntity="Notemonprof\UserBundle\Entity\Classe")
     */
    protected $classe;

    /**
     * @ORM\Column(name="duree", type="integer", nullable=false)
     * @Assert\Type(type="numeric", message="Doit etre un nombre")
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     *      minMessage = "La durée est forcément positive",
     *      maxMessage = "La note est forcément inférieur a 5"
     * )
     */

    private $duree;

    /**
     * @ORM\Column(name="date", type="date", nullable=false)
     */

    private $date;




    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set abrv
     *
     * @param string $abrv
     * @return Cours
     */
    public function setAbrv($abrv)
    {
        $this->abrv = $abrv;

        return $this;
    }

    /**
     * Get abrv
     *
     * @return string 
     */
    public function getAbrv()
    {
        return $this->abrv;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return Cours
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

public function __toString(){

    return $this->abrv;
}

    /**
     * Set cours
     *
     * @param \Notemonprof\UserBundle\Entity\Cours $cours
     * @return Cours
     */
    public function setCours(\Notemonprof\UserBundle\Entity\Cours $cours = null)
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * Get cours
     *
     * @return \Notemonprof\UserBundle\Entity\Cours 
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Set user
     *
     * @param \Notemonprof\UserBundle\Entity\User $user
     * @return Cours
     */
    public function setUser(\Notemonprof\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Notemonprof\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set classe
     *
     * @param \Notemonprof\UserBundle\Entity\Classe $classe
     * @return Cours
     */
    public function setClasse(\Notemonprof\UserBundle\Entity\Classe $classe = null)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \Notemonprof\UserBundle\Entity\Classe 
     */
    public function getClasse()
    {
        return $this->classe;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->classe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set duree
     *
     * @param integer $duree
     * @return Cours
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Cours
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add classe
     *
     * @param \Notemonprof\UserBundle\Entity\Classe $classe
     * @return Cours
     */
    public function addClasse(\Notemonprof\UserBundle\Entity\Classe $classe)
    {
        $this->classe[] = $classe;

        return $this;
    }

    /**
     * Remove classe
     *
     * @param \Notemonprof\UserBundle\Entity\Classe $classe
     */
    public function removeClasse(\Notemonprof\UserBundle\Entity\Classe $classe)
    {
        $this->classe->removeElement($classe);
    }
}
