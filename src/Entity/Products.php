<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private $id;

    #[Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[Column(type: 'string', length: 255, nullable: true)]
    private $sku;

    #[Column(type: 'string', length: 255, nullable: true)]
    private $amount;

    #[Column(type: 'string', length: 255, nullable: true)]
    private $picture;

    #[Column(type: 'string', length: 255, nullable: true)]
    private $brand;

    #[Column(type: 'string', nullable: true)]
    private $date;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $permalink = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_created = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_created_gmt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_modified = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_modified_gmt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featured = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $catalog_visibility = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $short_description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $regular_price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_on_sale_from = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_on_sale_from_gmt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_on_sale_to = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_on_sale_to_gmt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $on_sale = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $total_sales = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stock_quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stock_status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $backorders = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $backorders_allowed = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sold_individuality = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $wigth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idProduct = null;
   

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPermalink(): ?string
    {
        return $this->permalink;
    }

    public function setPermalink(?string $permalink): self
    {
        $this->permalink = $permalink;

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

    public function getDateCreatedGmt(): ?string
    {
        return $this->date_created_gmt;
    }

    public function setDateCreatedGmt(?string $date_created_gmt): self
    {
        $this->date_created_gmt = $date_created_gmt;

        return $this;
    }

    public function getDateModified(): ?string
    {
        return $this->date_modified;
    }

    public function setDateModified(?string $date_modified): self
    {
        $this->date_modified = $date_modified;

        return $this;
    }

    public function getDateModifiedGmt(): ?string
    {
        return $this->date_modified_gmt;
    }

    public function setDateModifiedGmt(?string $date_modified_gmt): self
    {
        $this->date_modified_gmt = $date_modified_gmt;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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

    public function getFeatured(): ?string
    {
        return $this->featured;
    }

    public function setFeatured(?string $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    public function getCatalogVisibility(): ?string
    {
        return $this->catalog_visibility;
    }

    public function setCatalogVisibility(?string $catalog_visibility): self
    {
        $this->catalog_visibility = $catalog_visibility;

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

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): self
    {
        $this->short_description = $short_description;

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

    public function getDateOnSaleFrom(): ?string
    {
        return $this->date_on_sale_from;
    }

    public function setDateOnSaleFrom(?string $date_on_sale_from): self
    {
        $this->date_on_sale_from = $date_on_sale_from;

        return $this;
    }

    public function getDateOnSaleFromGmt(): ?string
    {
        return $this->date_on_sale_from_gmt;
    }

    public function setDateOnSaleFromGmt(?string $date_on_sale_from_gmt): self
    {
        $this->date_on_sale_from_gmt = $date_on_sale_from_gmt;

        return $this;
    }

    public function getDateOnSaleTo(): ?string
    {
        return $this->date_on_sale_to;
    }

    public function setDateOnSaleTo(?string $date_on_sale_to): self
    {
        $this->date_on_sale_to = $date_on_sale_to;

        return $this;
    }

    public function getDateOnSaleToGmt(): ?string
    {
        return $this->date_on_sale_to_gmt;
    }

    public function setDateOnSaleToGmt(?string $date_on_sale_to_gmt): self
    {
        $this->date_on_sale_to_gmt = $date_on_sale_to_gmt;

        return $this;
    }

    public function getOnSale(): ?string
    {
        return $this->on_sale;
    }

    public function setOnSale(?string $on_sale): self
    {
        $this->on_sale = $on_sale;

        return $this;
    }

    public function getTotalSales(): ?string
    {
        return $this->total_sales;
    }

    public function setTotalSales(?string $total_sales): self
    {
        $this->total_sales = $total_sales;

        return $this;
    }

    public function getStockQuantity(): ?string
    {
        return $this->stock_quantity;
    }

    public function setStockQuantity(?string $stock_quantity): self
    {
        $this->stock_quantity = $stock_quantity;

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

    public function getBackorders(): ?string
    {
        return $this->backorders;
    }

    public function setBackorders(?string $backorders): self
    {
        $this->backorders = $backorders;

        return $this;
    }

    public function getBackordersAllowed(): ?string
    {
        return $this->backorders_allowed;
    }

    public function setBackordersAllowed(?string $backorders_allowed): self
    {
        $this->backorders_allowed = $backorders_allowed;

        return $this;
    }

    public function getSoldIndividuality(): ?string
    {
        return $this->sold_individuality;
    }

    public function setSoldIndividuality(?string $sold_individuality): self
    {
        $this->sold_individuality = $sold_individuality;

        return $this;
    }

    public function getWigth(): ?string
    {
        return $this->wigth;
    }

    public function setWigth(?string $wigth): self
    {
        $this->wigth = $wigth;

        return $this;
    }

    public function getIdProduct(): ?string
    {
        return $this->idProduct;
    }

    public function setIdProduct(?string $idProduct): self
    {
        $this->idProduct = $idProduct;

        return $this;
    }

   
}
