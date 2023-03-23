<?php

class Order
{
    public function __construct(
        public string $originalInput,
        public bool $valid = false,
        public ?string $date = null,
        public ?string $size = null,
        public ?string $carrier = null,
        public ?string $price = null,
        public ?string $discount = "0.00"
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
}
