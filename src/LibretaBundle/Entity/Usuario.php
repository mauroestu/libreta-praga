<?php
namespace LibretaBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="LibretaBundle\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
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
     * @ORM\Column(name="nombre_completo", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nombreCompleto;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(
     *  message = "El email {{ value }} no es un email válido.",
     *  checkMX = false
     *)
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasenia", type="string", length=64)
     */
    private $password;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    /**
     * @ORM\OneToMany(targetEntity="libreta", mappedBy="usuario")
     */
    private $libretas;
    
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }
    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }
    public function getRoles()
    {
        return array('ROLE_USER');
    }
    public function eraseCredentials()
    {
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
     * Set nombreCompletro
     *
     * @param string $nombreCompletro
     *
     * @return Usuario
     */
    public function setNombreCompleto($nombreCompletro)
    {
        $this->nombreCompleto = $nombreCompletro;
        return $this;
    }
    /**
     * Get nombreCompletro
     *
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get correo
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set contrasenia
     *
     * @param string $contrasenia
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * Get contrasenia
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Usuario
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
