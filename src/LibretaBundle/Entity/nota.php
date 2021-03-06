<?php

namespace LibretaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * nota
 *
 * @ORM\Table(name="nota")
 * @ORM\Entity(repositoryClass="LibretaBundle\Repository\notaRepository")
 */
class nota
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
     * @Assert\NotBlank()
     * @ORM\Column(name="nota", type="string", length=100)
     */
    private $nota;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=500)
     */
    private $contenido;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;


    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="libreta", inversedBy="notas")
     * @ORM\JoinColumn(name="libreta", referencedColumnName="id")
     */
    private $libreta;

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
     * Set nota
     *
     * @param string $nota
     *
     * @return nota
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return string
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return nota
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return nota
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
     * Set libreta
     *
     * @param \LibretaBundle\Entity\libreta $libreta
     *
     * @return nota
     */
    public function setLibreta(\LibretaBundle\Entity\libreta $libreta = null)
    {
        $this->libreta = $libreta;

        return $this;
    }

    /**
     * Get libreta
     *
     * @return \LibretaBundle\Entity\libreta
     */
    public function getLibreta()
    {
        return $this->libreta;
    }
}
