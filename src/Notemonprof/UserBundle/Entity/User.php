<?php
namespace Notemonprof\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Notemonprof\UserBundle\Entity\Classe")
     */
    protected $classe;




    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * Set classe
     *
     * @param \Notemonprof\UserBundle\Entity\Classe $classe
     * @return User
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
     * Set cours
     *
     * @param \Notemonprof\UserBundle\Entity\Cours $cours
     * @return User
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
}
