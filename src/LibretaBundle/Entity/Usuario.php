<?php
namespace LibretaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="LibretaBundle\Repository\UsuarioRepository")
 */
class Usuario extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="libreta", mappedBy="usuario")
     */
    protected $libretas;


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
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->libretas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add libreta
     *
     * @param \LibretaBundle\Entity\libreta $libreta
     *
     * @return Usuario
     */
    public function addLibreta(\LibretaBundle\Entity\libreta $libreta)
    {
        $this->libretas[] = $libreta;
        return $this;
    }
    /**
     * Remove libreta
     *
     * @param \LibretaBundle\Entity\libreta $libreta
     */
    public function removeLibreta(\LibretaBundle\Entity\libreta $libreta)
    {
        $this->libretas->removeElement($libreta);
    }
    /**
     * Get libretas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLibretas()
    {
        return $this->libretas;
    }
}
