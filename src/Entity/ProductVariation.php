<?php

namespace App\Entity;

use App\Repository\ProductVariationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductVariationRepository::class)]
class ProductVariation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $id_variation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_created = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sku = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $regular_price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sale_price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stock_status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $id_product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVariation(): ?string
    {
        return $this->id_variation;
    }

    public function setIdVariation(?string $id_variation): self
    {
        $this->id_variation = $id_variation;

        return $this;
    }

    public function getDateCreated(): ?string
    {
        return $this->date_created;
    }

    public function setDateCreated(?string $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRegularPrice(): ?string
    {
        return $this->regular_price;
    }

    public function setRegularPrice(?string $regular_price): self
    {
        $this->regular_price = $regular_price;

        return $this;
    }

    public function getSalePrice(): ?string
    {
        return $this->sale_price;
    }

    public function setSalePrice(?string $sale_price): self
    {
        $this->sale_price = $sale_price;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStockStatus(): ?string
    {
        return $this->stock_status;
    }

    public function setStockStatus(?string $stock_status): self
    {
        $this->stock_status = $stock_status;

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
}
