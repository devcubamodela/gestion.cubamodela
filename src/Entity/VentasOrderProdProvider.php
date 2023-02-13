<?php

namespace App\Entity;

use App\Repository\VentasOrderProdProviderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VentasOrderProdProviderRepository::class)]
class VentasOrderProdProvider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $id_order = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $id_product = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sku = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $id_proveedor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_prove = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fecha = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cost_prov = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOrder(): ?string
    {
        return $this->id_order;
    }

    public function setIdOrder(?string $id_order): self
    {
        $this->id_order = $id_order;

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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getIdProveedor(): ?string
    {
        return $this->id_proveedor;
    }

    public function setIdProveedor(?string $id_proveedor): self
    {
        $this->id_proveedor = $id_proveedor;

        return $this;
    }

    public function getNomProve(): ?string
    {
        return $this->nom_prove;
    }

    public function setNomProve(?string $nom_prove): self
    {
        $this->nom_prove = $nom_prove;

        return $this;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(?string $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCostProv(): ?string
    {
        return $this->cost_prov;
    }

    public function setCostProv(?string $cost_prov): self
    {
        $this->cost_prov = $cost_prov;

        return $this;
    }
}
