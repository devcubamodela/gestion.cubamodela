<?php

namespace App\Entity;

use App\Repository\ProviderProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderProductRepository::class)]
class ProviderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomb_provider = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $id_product = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cost = null;

    #[ORM\Column(length: 255)]
    private ?string $Id_Prvider = null;

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombProvider(): ?string
    {
        return $this->nomb_provider;
    }

    public function setNombProvider(?string $nomb_provider): self
    {
        $this->nomb_provider = $nomb_provider;

        return $this;
    }

    public function getIdProduct(): ?string
    {
        return $this->id_product;
    }

    public function setIdProduct(?string $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(?string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getIdPrvider(): ?string
    {
        return $this->Id_Prvider;
    }

    public function setIdPrvider(string $Id_Prvider): static
    {
        $this->Id_Prvider = $Id_Prvider;

        return $this;
    }

  
}
