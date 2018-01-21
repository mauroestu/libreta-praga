<?php

namespace LibretaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * libreta
 *
 * @ORM\Table(name="libreta")
 * @ORM\Entity(repositoryClass="LibretaBundle\Repository\libretaRepository")
 */
class libreta
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500)
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;


    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="libretas")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     */
    private $usuario;


    /**
     * @ORM\ManyToOne(targetEntity="Tipo", inversedBy="libretas")
     * @ORM\JoinColumn(name="tipo", referencedColumnName="id")
     */
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity="libreta", mappedBy="libreta")
     */
    private $notas;

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
     * @return libreta
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return libreta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return libreta
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
        $this->notas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set usuario
     *
     * @param \LibretaBundle\Entity\Usuario $usuario
     *
     * @return libreta
     */
    public function setUsuario(\LibretaBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \LibretaBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set tipo
     *
     * @param \LibretaBundle\Entity\Tipo $tipo
     *
     * @return libreta
     */
    public function setTipo(\LibretaBundle\Entity\Tipo $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \LibretaBundle\Entity\Tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add nota
     *
     * @param \LibretaBundle\Entity\libreta $nota
     *
     * @return libreta
     */
    public function addNota(\LibretaBundle\Entity\libreta $nota)
    {
        $this->notas[] = $nota;

        return $this;
    }

    /**
     * Remove nota
     *
     * @param \LibretaBundle\Entity\libreta $nota
     */
    public function removeNota(\LibretaBundle\Entity\libreta $nota)
    {
        $this->notas->removeElement($nota);
    }

    /**
     * Get notas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotas()
    {
        return $this->notas;
    }
}
