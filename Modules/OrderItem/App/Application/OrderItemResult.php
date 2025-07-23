<?php

namespace Modules\OrderItem\App\Application;

use Modules\OrderItem\App\Models\OrderItem;
use Modules\Product\App\Application\ProductResult;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'OrderItemResult',
    title: 'Order Item response',
    properties: [
        new OAT\Property(property: 'id', type: 'integer', example: 1),
        new OAT\Property(property: 'quantity', type: 'integer', example: 2),
        new OAT\Property(property: 'price', type: 'number', format: 'float', example: 349.51),
        new OAT\Property(property: 'discount', type: 'number', format: 'float', example: 100),
        new OAT\Property(
            property: 'product',
            ref: '#/components/schemas/ProductResult'
        ),
    ],
    type: 'object'
)]
final class OrderItemResult implements \JsonSerializable
{
    public function __construct(
        private int $id,
        private int $quantity,
        private ?float $price,
        private ?float $discount,
        private ?ProductResult $product,
    ) {}

    public static function fromModel(OrderItem $item): self
    {
        return new self(
            id: $item->id,
            quantity: $item->quantity,
            price: $item->price,
            discount: $item->discount,
            product: $item->relationLoaded('product') && $item->product !== null
                ? ProductResult::fromModel($item->product)
                : null,
        );
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'product' => $this->product,
        ];
    }
}
