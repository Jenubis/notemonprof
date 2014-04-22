<?php

namespace Notemonprof\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity
 */
class Classe
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
     * @return Classe
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
     * @return Classe
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
}
