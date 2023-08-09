<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
class Provider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codigo = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $idProducts = [];

    #[ORM\Column(length: 255)]
    private ?string $id_Proveedor = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getIdProducts(): array
    {
        return $this->idProducts;
    }

    public function setIdProducts(?array $idProducts): static
    {
        $this->idProducts = $idProducts;

        return $this;
    }

    public function getIdProveedor(): ?string
    {
        return $this->id_Proveedor;
    }

    public function setIdProveedor(string $id_Proveedor): static
    {
        $this->id_Proveedor = $id_Proveedor;

        return $this;
    }
  
}
