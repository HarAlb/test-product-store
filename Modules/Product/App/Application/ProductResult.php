<?php

namespace Modules\Product\App\Application;

use Modules\Category\App\Application\CategoryResult;
use Modules\Currency\App\Application\CurrencyResult;
use Modules\Product\App\Models\Product;
use OpenApi\Attributes as OAT;

#[
    OAT\Schema(
        schema: 'ProductResult',
        title: 'Product response',
        properties: [
            new OAT\Property(property: 'id', type: 'integer', example: 1001),
            new OAT\Property(property: 'name', type: 'string', example: 'iPhone 15'),
            new OAT\Property(property: 'description', type: 'string', example: 'Apple iPhone 15 with 256GB storage'),
            new OAT\Property(property: 'price', type: 'number', format: 'float', example: 1299.99),
            new OAT\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2025-07-23T10:15:30Z'),
            new OAT\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2025-07-23T12:00:00Z'),
            new OAT\Property(
                property: 'currency',
                ref: '#/components/schemas/CurrencyResult'
            ),
            new OAT\Property(
                property: 'category',
                ref: '#/components/schemas/CategoryResult'
            ),
        ],
        type: 'object'
    )
]
final class ProductResult implements \JsonSerializable
{
    public function __construct(
        private int $id,
        private string $name,
        private string $description,
        private float $price,
        private string $createdAt,
        private string $updatedAt,
        private CurrencyResult $currency,
        private CategoryResult $category,
    ) {}

    public static function fromModel(Product $product): self
    {
        return new self(
            id: $product->id,
            name: $product->name,
            description: $product->description,
            price: (float) $product->price,
            createdAt: $product->created_at->toIso8601String(),
            updatedAt: $product->updated_at->toIso8601String(),
            currency: CurrencyResult::fromModel($product->currency),
            category: CategoryResult::fromModel($product->category)
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'currency' => $this->currency,
            'category' => $this->category,
        ];
    }
}
