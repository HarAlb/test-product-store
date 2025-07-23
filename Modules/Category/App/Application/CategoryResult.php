<?php

namespace Modules\Category\App\Application;

use Modules\Category\App\Models\Category;
use OpenApi\Attributes as OAT;

#[
    OAT\Schema(
        schema: 'CategoryResult',
        title: 'Category response',
        properties: [
            new OAT\Property(property: 'id', type: 'integer', example: 123),
            new OAT\Property(property: 'name', type: 'string', example: 'Some'),
            new OAT\Property(property: 'slug', type: 'string', example: 'some'),
        ],
        type: 'object'
    )
]
final class CategoryResult implements \JsonSerializable
{
    public function __construct(
        private int $id,
        private string $name,
        private string $slug,
    ) {}

    public static function fromModel(Category $category): self
    {
        return new self(
            id: $category->id,
            name: $category->name,
            slug: $category->slug,
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
