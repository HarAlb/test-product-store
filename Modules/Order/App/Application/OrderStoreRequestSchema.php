<?php

namespace Modules\Order\App\Application;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'OrderStoreRequestSchema',
    required: ['items'],
    properties: [
        new OAT\Property(
            property: 'items',
            type: 'array',
            items: new OAT\Items(
                required: ['product_id', 'quantity'],
                properties: [
                    new OAT\Property(property: 'product_id', type: 'integer', example: 123),
                    new OAT\Property(property: 'quantity', type: 'number', format: 'float', example: 1.5),
                ],
                type: 'object'
            ),
            minItems: 1
        ),
    ]
)]
class OrderStoreRequestSchema {}
