<?php

namespace App\Entity;

use App\Repository\ClavesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClavesRepository::class)]
class Claves
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ck = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCk(): ?string
    {
        return $this->ck;
    }

    public function setCk(?string $ck): self
    {
        $this->ck = $ck;

        return $this;
    }

    public function getCs(): ?string
    {
        return $this->cs;
    }

    public function setCs(?string $cs): self
    {
        $this->cs = $cs;

        return $this;
    }
}
