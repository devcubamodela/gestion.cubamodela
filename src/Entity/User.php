<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Ya existe un usuario con ese email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
   
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Length(
        min: 6,
        minMessage: 'Tu contraseña debe tener al menos {{ limit }} caracteres',
    )]
    #[Assert\NotCompromisedPassword]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 40,
        minMessage: 'Tu nombre debe tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu nombre no puede ser mas de {{ limit }} caracteres',
    )]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 40,
        minMessage: 'Tu apellido debe tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu apellido no puede ser mas de {{ limit }} caracteres',
    )]
    private ?string $apellidos = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 8,
        max: 10,
        minMessage: 'Tu telefono debe tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu telefono no puede ser mas de {{ limit }} caracteres',
    )]
    private ?int $telefono = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $marca = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(?int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(?string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
