<?php

namespace App\Entity;

use App\Repository\ValeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ValeRepository::class)]
class Vale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $idProducto = null;

    #[ORM\Column]
    private ?float $cantidad = null;

    #[ORM\Column(length: 255)]
    private ?string $unidadMedida = null;

    #[ORM\Column]
    private ?int $idAlmacen = null;

    #[ORM\Column(length: 255)]
    private ?string $recpDesp = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getIdProducto(): ?string
    {
        return $this->idProducto;
    }

    public function setIdProducto(string $idProducto): static
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    public function getCantidad(): ?float
    {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getUnidadMedida(): ?string
    {
        return $this->unidadMedida;
    }

    public function setUnidadMedida(string $unidadMedida): static
    {
        $this->unidadMedida = $unidadMedida;

        return $this;
    }

    public function getIdAlmacen(): ?int
    {
        return $this->idAlmacen;
    }

    public function setIdAlmacen(int $idAlmacen): static
    {
        $this->idAlmacen = $idAlmacen;

        return $this;
    }

    public function getRecpDesp(): ?string
    {
        return $this->recpDesp;
    }

    public function setRecpDesp(string $recpDesp): static
    {
        $this->recpDesp = $recpDesp;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }
}
