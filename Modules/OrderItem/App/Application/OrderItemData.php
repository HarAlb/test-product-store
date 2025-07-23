<?php

namespace Modules\OrderItem\App\Application;

class OrderItemData
{
    public function __construct(
        public int $productId,
        public int $quantity,
        public ?int $orderId = null,
        public ?float $price = null,
        public ?float $discount = null,
    ) {}

    public function setOrderId(?int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }
}
