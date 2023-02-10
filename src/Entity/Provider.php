<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
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
    private ?string $productid = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sku = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $product_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $costo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cant_vendidas = null;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getProductid(): ?string
    {
        return $this->productid;
    }

    public function setProductid(?string $productid): self
    {
        $this->productid = $productid;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(?string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getCosto(): ?string
    {
        return $this->costo;
    }

    public function setCosto(?string $costo): self
    {
        $this->costo = $costo;

        return $this;
    }

    public function getCantVendidas(): ?string
    {
        return $this->cant_vendidas;
    }

    public function setCantVendidas(?string $cant_vendidas): self
    {
        $this->cant_vendidas = $cant_vendidas;

        return $this;
    }
}
