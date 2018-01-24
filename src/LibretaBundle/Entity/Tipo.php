<?php

namespace LibretaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo
 *
 * @ORM\Table(name="tipo")
 * @ORM\Entity(repositoryClass="LibretaBundle\Repository\TipoRepository")
 */
class Tipo
{

    const CONST_NOTA_MENTAL = 1;
    const CONST_NOTA_ENTRETENIMIENTO = 2;
    const CONST_NOTA_ACADEMICA = 3;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;


    /**
     * @ORM\OneToMany(targetEntity="libreta", mappedBy="tipo")
     */
    private $libretas;


    /**
    *Set id
    *
    *@param int $id
    *
    *@return id
    */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tipo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Tipo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return bool
     */
    public function getActivo()
    {
        return $this->activo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->libretas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add libreta
     *
     * @param \LibretaBundle\Entity\libreta $libreta
     *
     * @return Tipo
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
