<?php

class Order
{
    public function __construct(
        private string $originalInput,
        private bool $valid = false,
        private ?string $date = null,
        private ?string $size = null,
        private ?string $carrier = null,
        private ?string $price = null,
        private ?string $discount = "0.00"
    )
    {
        $this->originalInput = $originalInput;
        $this->valid = $valid;
        $this->date = $date;
        $this->size = $size;
        $this->carrier = $carrier;
        $this->price = $price;
        $this->discount = $discount;
    }

    public function setValid(bool $valid): void
    {
        $this->valid = $valid;
    }

    public function getValid(): bool
    {
        return $this->valid;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function setCarrier(string $carrier): void
    {
        $this->carrier = $carrier;
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setDiscount(string $discount): void
    {
        $this->discount = $discount;
    }

    public function getDiscount(): string
    {
        return $this->discount;
    }

    public function getOriginalInput(): string
    {
        return $this->originalInput;
    }
}
