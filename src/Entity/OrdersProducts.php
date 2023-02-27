<?php

namespace App\Entity;

use App\Repository\OrdersProductsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersProductsRepository::class)]
class OrdersProducts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_order = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOrder(): ?int
    {
        return $this->id_order;
    }

    public function setIdOrder(?int $id_order): self
    {
        $this->id_order = $id_order;

        return $this;
    }

    public function getIdProduct(): ?int
    {
        return $this->id_product;
    }

    public function setIdProduct(?int $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
    }
}
