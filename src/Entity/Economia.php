<?php

namespace App\Entity;

use App\Repository\EconomiaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EconomiaRepository::class)]
class Economia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $idProducto = null;

    #[ORM\Column(nullable: true)]
    private ?int $idOrden = null;

    #[ORM\Column(nullable: true)]
    private ?int $idProveedor = null;

    #[ORM\Column(nullable: true)]
    private ?bool $pagado = null;

    #[ORM\Column(type: Types::DATE_MUTABLE,nullable: true)]
    private ?\DateTimeInterface $fechaPagado = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $trazaPagado = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidadPagado = null;

    #[ORM\Column(length: 255)]
    private ?string $fecha_orden_efectuada = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProducto(): ?int
    {
        return $this->idProducto;
    }

    public function setIdProducto(int $idProducto): static
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    public function getIdOrden(): ?int
    {
        return $this->idOrden;
    }

    public function setIdOrden(int $idOrden): static
    {
        $this->idOrden = $idOrden;

        return $this;
    }

    public function getIdProveedor(): ?int
    {
        return $this->idProveedor;
    }

    public function setIdProveedor(int $idProveedor): static
    {
        $this->idProveedor = $idProveedor;

        return $this;
    }

    public function isPagado(): ?bool
    {
        return $this->pagado;
    }

    public function setPagado(bool $pagado): static
    {
        $this->pagado = $pagado;

        return $this;
    }

    public function getFechaPagado(): ?\DateTimeInterface
    {
        return $this->fechaPagado;
    }

    public function setFechaPagado(\DateTimeInterface $fechaPagado): static
    {
        $this->fechaPagado = $fechaPagado;

        return $this;
    }

    public function getTrazaPagado(): ?string
    {
        return $this->trazaPagado;
    }

    public function setTrazaPagado(string $trazaPagado): static
    {
        $this->trazaPagado = $trazaPagado;

        return $this;
    }

    public function getCantidadPagado(): ?int
    {
        return $this->cantidadPagado;
    }

    public function setCantidadPagado(int $cantidadPagado): static
    {
        $this->cantidadPagado = $cantidadPagado;

        return $this;
    }

    public function getFechaOrdenEfectuada(): ?string
    {
        return $this->fecha_orden_efectuada;
    }

    public function setFechaOrdenEfectuada(string $fecha_orden_efectuada): static
    {
        $this->fecha_orden_efectuada = $fecha_orden_efectuada;

        return $this;
    }
}
