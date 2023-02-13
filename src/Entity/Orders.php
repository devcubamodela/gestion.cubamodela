<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $orderId = null;

    #[ORM\Column(nullable: true)]
    private ?int $parent_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $order_key = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $created_via = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $version = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $currency = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_created = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_modified = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $discount_total = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $discount_tax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_total = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_tax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cart_tax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $total = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prices_include_tax = null;

    #[ORM\Column(nullable: true)]
    private ?int $customer_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customer_ip_address = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $customer_user_agent = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $customer_note = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_address_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_address_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $payment_method = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $payment_method_title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_paid = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $productos = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(?int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function setParentId(?int $parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getOrderKey(): ?string
    {
        return $this->order_key;
    }

    public function setOrderKey(?string $order_key): self
    {
        $this->order_key = $order_key;

        return $this;
    }

    public function getCreatedVia(): ?string
    {
        return $this->created_via;
    }

    public function setCreatedVia(?string $created_via): self
    {
        $this->created_via = $created_via;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): self
    {
        $this->version = $version;

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

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

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

    public function getDateModified(): ?string
    {
        return $this->date_modified;
    }

    public function setDateModified(?string $date_modified): self
    {
        $this->date_modified = $date_modified;

        return $this;
    }

    public function getDiscountTotal(): ?string
    {
        return $this->discount_total;
    }

    public function setDiscountTotal(?string $discount_total): self
    {
        $this->discount_total = $discount_total;

        return $this;
    }

    public function getDiscountTax(): ?string
    {
        return $this->discount_tax;
    }

    public function setDiscountTax(?string $discount_tax): self
    {
        $this->discount_tax = $discount_tax;

        return $this;
    }

    public function getShippingTotal(): ?string
    {
        return $this->shipping_total;
    }

    public function setShippingTotal(?string $shipping_total): self
    {
        $this->shipping_total = $shipping_total;

        return $this;
    }

    public function getShippingTax(): ?string
    {
        return $this->shipping_tax;
    }

    public function setShippingTax(?string $shipping_tax): self
    {
        $this->shipping_tax = $shipping_tax;

        return $this;
    }

    public function getCartTax(): ?string
    {
        return $this->cart_tax;
    }

    public function setCartTax(?string $cart_tax): self
    {
        $this->cart_tax = $cart_tax;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getPricesIncludeTax(): ?string
    {
        return $this->prices_include_tax;
    }

    public function setPricesIncludeTax(?string $prices_include_tax): self
    {
        $this->prices_include_tax = $prices_include_tax;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(?int $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    public function getCustomerIpAddress(): ?string
    {
        return $this->customer_ip_address;
    }

    public function setCustomerIpAddress(?string $customer_ip_address): self
    {
        $this->customer_ip_address = $customer_ip_address;

        return $this;
    }

    public function getCustomerUserAgent(): ?string
    {
        return $this->customer_user_agent;
    }

    public function setCustomerUserAgent(?string $customer_user_agent): self
    {
        $this->customer_user_agent = $customer_user_agent;

        return $this;
    }

    public function getCustomerNote(): ?string
    {
        return $this->customer_note;
    }

    public function setCustomerNote(?string $customer_note): self
    {
        $this->customer_note = $customer_note;

        return $this;
    }

    public function getBillingFirstName(): ?string
    {
        return $this->billing_first_name;
    }

    public function setBillingFirstName(?string $billing_first_name): self
    {
        $this->billing_first_name = $billing_first_name;

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

    public function getBillingAddress1(): ?string
    {
        return $this->billing_address_1;
    }

    public function setBillingAddress1(?string $billing_address_1): self
    {
        $this->billing_address_1 = $billing_address_1;

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

    public function getShippingFirstName(): ?string
    {
        return $this->shipping_first_name;
    }

    public function setShippingFirstName(?string $shipping_first_name): self
    {
        $this->shipping_first_name = $shipping_first_name;

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

    public function getShippingAddress1(): ?string
    {
        return $this->shipping_address_1;
    }

    public function setShippingAddress1(?string $shipping_address_1): self
    {
        $this->shipping_address_1 = $shipping_address_1;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(?string $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    public function getPaymentMethodTitle(): ?string
    {
        return $this->payment_method_title;
    }

    public function setPaymentMethodTitle(?string $payment_method_title): self
    {
        $this->payment_method_title = $payment_method_title;

        return $this;
    }

    public function getDatePaid(): ?string
    {
        return $this->date_paid;
    }

    public function setDatePaid(?string $date_paid): self
    {
        $this->date_paid = $date_paid;

        return $this;
    }

    public function getProductos(): array
    {
        return $this->productos;
    }

    public function setProductos(?array $productos): self
    {
        $this->productos = $productos;

        return $this;
    }
}
