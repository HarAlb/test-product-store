<?php

namespace Modules\Shared\App\Application;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'PaginatedList',
    title: 'Paginated List',
    properties: [
        new OAT\Property(
            property: 'data',
            type: 'array',
            items: new OAT\Items(
                oneOf: [
                    new OAT\Schema(ref: '#/components/schemas/ProductResult'),
                    new OAT\Schema(ref: '#/components/schemas/OrderResult'),
                ]
            )
        ),
        new OAT\Property(
            property: 'meta',
            ref: '#/components/schemas/PaginationMeta'
        ),
    ],
    type: 'object'
)]
class PaginatedList implements \JsonSerializable
{
    public function __construct(
        private readonly array $data,
        private readonly int $total,
        private readonly int $page,
        private readonly int $perPage
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'data' => $this->data,
            'meta' => [
                'page' => $this->page,
                'per_page' => $this->perPage,
                'total' => $this->total,
                'total_pages' => (int) ceil($this->total / $this->perPage),
            ],
        ];
    }
}
