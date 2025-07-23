<?php

namespace Modules\Order\App\Application;

use Modules\Order\App\Models\Order;
use Modules\OrderItem\App\Application\OrderItemResult;
use Modules\User\App\Application\UserResult;
use OpenApi\Attributes as OAT;

#[
    OAT\Schema(
        schema: 'OrderResult',
        title: 'Order response',
        properties: [
            new OAT\Property(property: 'id', type: 'integer', example: 1001),
            new OAT\Property(property: 'total_price', type: 'number', format: 'float', example: 1299.99),
            new OAT\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2025-07-23T10:15:30Z'),
            new OAT\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2025-07-23T12:00:00Z'),
            new OAT\Property(
                property: 'user',
                ref: '#/components/schemas/UserResult'
            ),
            new OAT\Property(
                property: 'items',
                type: 'array',
                items: new OAT\Items(ref: '#/components/schemas/OrderItemResult')
            ),
        ],
        type: 'object'
    )
]
final class OrderResult implements \JsonSerializable
{
    public function __construct(
        private int $id,
        private float $totalPrice,
        private string $createdAt,
        private string $updatedAt,
        private ?UserResult $user,
        private ?array $items = null,
    ) {}

    public static function fromModel(Order $order): self
    {
        $userResult = null;

        if ($order->relationLoaded('user') && $order->user !== null) {
            $userResult = UserResult::fromModel($order->user);
        }

        $itemsResult = null;
        if ($order->relationLoaded('items') && $order->items !== null) {
            $itemsResult = $order->items->map(fn ($item) => OrderItemResult::fromModel($item))->all();
        }

        return new self(
            id: $order->id,
            totalPrice: (float) $order->total_price,
            createdAt: $order->created_at->toIso8601String(),
            updatedAt: $order->updated_at->toIso8601String(),
            user: $userResult,
            items: $itemsResult
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'total_price' => $this->totalPrice,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'user' => $this->user,
            'items' => $this->items,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUser(): ?UserResult
    {
        return $this->user;
    }

    public function setUser(?UserResult $user): void
    {
        $this->user = $user;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function addItem(OrderItemResult $item): void
    {
        $this->items[] = $item;
    }
}
