<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_customer = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_created = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_created_gmt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_modified = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_modified_gmt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $role = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_firs_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_company = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_address_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_address_2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_state = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_postcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_firs_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_company = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_address_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_address_2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_state = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_postcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_country = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_paying_customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCustomer(): ?int
    {
        return $this->id_customer;
    }

    public function setIdCustomer(int $id_customer): self
    {
        $this->id_customer = $id_customer;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(?\DateTimeInterface $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDateCreatedGmt(): ?\DateTimeInterface
    {
        return $this->date_created_gmt;
    }

    public function setDateCreatedGmt(?\DateTimeInterface $date_created_gmt): self
    {
        $this->date_created_gmt = $date_created_gmt;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->date_modified;
    }

    public function setDateModified(?\DateTimeInterface $date_modified): self
    {
        $this->date_modified = $date_modified;

        return $this;
    }

    public function getDateModifiedGmt(): ?\DateTimeInterface
    {
        return $this->date_modified_gmt;
    }

    public function setDateModifiedGmt(?\DateTimeInterface $date_modified_gmt): self
    {
        $this->date_modified_gmt = $date_modified_gmt;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getBillingFirsName(): ?string
    {
        return $this->billing_firs_name;
    }

    public function setBillingFirsName(?string $billing_firs_name): self
    {
        $this->billing_firs_name = $billing_firs_name;

        return $this;
    }

    public function getBillingLastName(): ?string
    {
        return $this->billing_last_name;
    }

    public function setBillingLastName(?string $billing_last_name): self
    {
        $this->billing_last_name = $billing_last_name;

        return $this;
    }

    public function getBillingCompany(): ?string
    {
        return $this->billing_company;
    }

    public function setBillingCompany(?string $billing_company): self
    {
        $this->billing_company = $billing_company;

        return $this;
    }

    public function getBillingAddress1(): ?string
    {
        return $this->billing_address_1;
    }

    public function setBillingAddress1(?string $billing_address_1): self
    {
        $this->billing_address_1 = $billing_address_1;

        return $this;
    }

    public function getBillingAddress2(): ?string
    {
        return $this->billing_address_2;
    }

    public function setBillingAddress2(?string $billing_address_2): self
    {
        $this->billing_address_2 = $billing_address_2;

        return $this;
    }

    public function getBillingCity(): ?string
    {
        return $this->billing_city;
    }

    public function setBillingCity(?string $billing_city): self
    {
        $this->billing_city = $billing_city;

        return $this;
    }

    public function getBillingState(): ?string
    {
        return $this->billing_state;
    }

    public function setBillingState(?string $billing_state): self
    {
        $this->billing_state = $billing_state;

        return $this;
    }

    public function getBillingPostcode(): ?string
    {
        return $this->billing_postcode;
    }

    public function setBillingPostcode(?string $billing_postcode): self
    {
        $this->billing_postcode = $billing_postcode;

        return $this;
    }

    public function getBillingCountry(): ?string
    {
        return $this->billing_country;
    }

    public function setBillingCountry(?string $billing_country): self
    {
        $this->billing_country = $billing_country;

        return $this;
    }

    public function getBillingEmail(): ?string
    {
        return $this->billing_email;
    }

    public function setBillingEmail(?string $billing_email): self
    {
        $this->billing_email = $billing_email;

        return $this;
    }

    public function getBillingPhone(): ?string
    {
        return $this->billing_phone;
    }

    public function setBillingPhone(?string $billing_phone): self
    {
        $this->billing_phone = $billing_phone;

        return $this;
    }

    public function getShippingFirsName(): ?string
    {
        return $this->shipping_firs_name;
    }

    public function setShippingFirsName(?string $shipping_firs_name): self
    {
        $this->shipping_firs_name = $shipping_firs_name;

        return $this;
    }

    public function getShippingLastName(): ?string
    {
        return $this->shipping_last_name;
    }

    public function setShippingLastName(?string $shipping_last_name): self
    {
        $this->shipping_last_name = $shipping_last_name;

        return $this;
    }

    public function getShippingCompany(): ?string
    {
        return $this->shipping_company;
    }

    public function setShippingCompany(?string $shipping_company): self
    {
        $this->shipping_company = $shipping_company;

        return $this;
    }

    public function getShippingAddress1(): ?string
    {
        return $this->shipping_address_1;
    }

    public function setShippingAddress1(?string $shipping_address_1): self
    {
        $this->shipping_address_1 = $shipping_address_1;

        return $this;
    }

    public function getShippingAddress2(): ?string
    {
        return $this->shipping_address_2;
    }

    public function setShippingAddress2(?string $shipping_address_2): self
    {
        $this->shipping_address_2 = $shipping_address_2;

        return $this;
    }

    public function getShippingCity(): ?string
    {
        return $this->shipping_city;
    }

    public function setShippingCity(?string $shipping_city): self
    {
        $this->shipping_city = $shipping_city;

        return $this;
    }

    public function getShippingState(): ?string
    {
        return $this->shipping_state;
    }

    public function setShippingState(?string $shipping_state): self
    {
        $this->shipping_state = $shipping_state;

        return $this;
    }

    public function getShippingPostcode(): ?string
    {
        return $this->shipping_postcode;
    }

    public function setShippingPostcode(?string $shipping_postcode): self
    {
        $this->shipping_postcode = $shipping_postcode;

        return $this;
    }

    public function getShippingCountry(): ?string
    {
        return $this->shipping_country;
    }

    public function setShippingCountry(?string $shipping_country): self
    {
        $this->shipping_country = $shipping_country;

        return $this;
    }

    public function isIsPayingCustomer(): ?bool
    {
        return $this->is_paying_customer;
    }

    public function setIsPayingCustomer(?bool $is_paying_customer): self
    {
        $this->is_paying_customer = $is_paying_customer;

        return $this;
    }
}
