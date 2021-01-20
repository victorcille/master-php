<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// Cargamos estas librerías para poder devolver un array collection de Tasks debido a la relación OneToMany que User tiene con Task
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

// Necesario cargar la UserInterface para el tema de registro, login, security, etc...
use Symfony\Component\Security\Core\User\UserInterface;

// Cargamos la librería Constraints para la validación de los campos de los formularios
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=true)
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex(
     *      pattern = "/[a-zA-Z ]+/", 
     *      message = "El campo debe ser rellenado sólo con letras"
     * )
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=200, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex(
     *      pattern = "/[a-zA-Z ]+/", 
     *      message = "El campo debe ser rellenado sólo con letras"
     * )
     */
    private $surname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Email(message = "El email '{{ value }}' no es válido")
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;
    
    
    /**
     * @var \Task
     *
     * @ORM\OneToMany(targetEntity="Task", mappedBy="user")
     */
    private $tasks;
    
    // Nos creamos el constructor
    public function __construct(){
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    
    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }
    
    // MÉTODOS AÑADIDOS DEBIDO A LA IMPLEMENTACIÓN DEL USERINTERFACE
    public function getUsername(){
        return $this->email;  // Devuelvo el email porque quiero que ese sea el username de los usuarios
    }
    
    public function getSalt(){
        return null;
    }
    
    public function getRoles(){
        // Comento esto porque en este caso vamos a devolver el ROLE_USER fijo siempre. 
        // Si nuestra aplicación tuviese otros roles, haríamos el $this->getRole()
        //return $this->getRole();
        
        return array('ROLE_USER');
    }
    
    public function eraseCredentials(){
        
    }

}
