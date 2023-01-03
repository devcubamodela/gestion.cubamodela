<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomersRepository::class)]
class Customers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $id_costumer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_created = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_created_gmt = null;

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
    private ?string $first_name_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $last_name_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address_1_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address_2_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postcode_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone_biling = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_name_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $last_name_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address_1_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address_2_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postcode_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country_shipping = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $is_paying_customer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar_url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCostumer(): ?string
    {
        return $this->id_costumer;
    }

    public function setIdCostumer(?string $id_costumer): self
    {
        $this->id_costumer = $id_costumer;

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

    public function getFirstNameBiling(): ?string
    {
        return $this->first_name_biling;
    }

    public function setFirstNameBiling(?string $first_name_biling): self
    {
        $this->first_name_biling = $first_name_biling;

        return $this;
    }

    public function getLastNameBiling(): ?string
    {
        return $this->last_name_biling;
    }

    public function setLastNameBiling(?string $last_name_biling): self
    {
        $this->last_name_biling = $last_name_biling;

        return $this;
    }

    public function getAddress1Biling(): ?string
    {
        return $this->address_1_biling;
    }

    public function setAddress1Biling(?string $address_1_biling): self
    {
        $this->address_1_biling = $address_1_biling;

        return $this;
    }

    public function getCompanyBiling(): ?string
    {
        return $this->company_biling;
    }

    public function setCompanyBiling(?string $company_biling): self
    {
        $this->company_biling = $company_biling;

        return $this;
    }

    public function getAddress2Biling(): ?string
    {
        return $this->address_2_biling;
    }

    public function setAddress2Biling(?string $address_2_biling): self
    {
        $this->address_2_biling = $address_2_biling;

        return $this;
    }

    public function getCityBiling(): ?string
    {
        return $this->city_biling;
    }

    public function setCityBiling(?string $city_biling): self
    {
        $this->city_biling = $city_biling;

        return $this;
    }

    public function getStateBiling(): ?string
    {
        return $this->state_biling;
    }

    public function setStateBiling(?string $state_biling): self
    {
        $this->state_biling = $state_biling;

        return $this;
    }

    public function getPostcodeBiling(): ?string
    {
        return $this->postcode_biling;
    }

    public function setPostcodeBiling(?string $postcode_biling): self
    {
        $this->postcode_biling = $postcode_biling;

        return $this;
    }

    public function getCountryBiling(): ?string
    {
        return $this->country_biling;
    }

    public function setCountryBiling(?string $country_biling): self
    {
        $this->country_biling = $country_biling;

        return $this;
    }

    public function getEmailBiling(): ?string
    {
        return $this->email_biling;
    }

    public function setEmailBiling(?string $email_biling): self
    {
        $this->email_biling = $email_biling;

        return $this;
    }

    public function getPhoneBiling(): ?string
    {
        return $this->phone_biling;
    }

    public function setPhoneBiling(?string $phone_biling): self
    {
        $this->phone_biling = $phone_biling;

        return $this;
    }

    public function getFirstNameShipping(): ?string
    {
        return $this->first_name_shipping;
    }

    public function setFirstNameShipping(?string $first_name_shipping): self
    {
        $this->first_name_shipping = $first_name_shipping;

        return $this;
    }

    public function getLastNameShipping(): ?string
    {
        return $this->last_name_shipping;
    }

    public function setLastNameShipping(?string $last_name_shipping): self
    {
        $this->last_name_shipping = $last_name_shipping;

        return $this;
    }

    public function getCompanyShipping(): ?string
    {
        return $this->company_shipping;
    }

    public function setCompanyShipping(?string $company_shipping): self
    {
        $this->company_shipping = $company_shipping;

        return $this;
    }

    public function getAddress1Shipping(): ?string
    {
        return $this->address_1_shipping;
    }

    public function setAddress1Shipping(?string $address_1_shipping): self
    {
        $this->address_1_shipping = $address_1_shipping;

        return $this;
    }

    public function getAddress2Shipping(): ?string
    {
        return $this->address_2_shipping;
    }

    public function setAddress2Shipping(?string $address_2_shipping): self
    {
        $this->address_2_shipping = $address_2_shipping;

        return $this;
    }

    public function getCityShipping(): ?string
    {
        return $this->city_shipping;
    }

    public function setCityShipping(?string $city_shipping): self
    {
        $this->city_shipping = $city_shipping;

        return $this;
    }

    public function getStateShipping(): ?string
    {
        return $this->state_shipping;
    }

    public function setStateShipping(?string $state_shipping): self
    {
        $this->state_shipping = $state_shipping;

        return $this;
    }

    public function getPostcodeShipping(): ?string
    {
        return $this->postcode_shipping;
    }

    public function setPostcodeShipping(?string $postcode_shipping): self
    {
        $this->postcode_shipping = $postcode_shipping;

        return $this;
    }

    public function getCountryShipping(): ?string
    {
        return $this->country_shipping;
    }

    public function setCountryShipping(?string $country_shipping): self
    {
        $this->country_shipping = $country_shipping;

        return $this;
    }

    public function isIsPayingCustomer(): ?string
    {
        return $this->is_paying_customer;
    }

    public function setIsPayingCustomer(string $is_paying_customer): self
    {
        $this->is_paying_customer = $is_paying_customer;

        return $this;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function setAvatarUrl(?string $avatar_url): self
    {
        $this->avatar_url = $avatar_url;

        return $this;
    }
}
