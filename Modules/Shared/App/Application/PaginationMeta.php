<?php

namespace Modules\Shared\App\Application;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'PaginationMeta',
    properties: [
        new OAT\Property(property: 'page', type: 'integer', example: 1),
        new OAT\Property(property: 'per_page', type: 'integer', example: 10),
        new OAT\Property(property: 'total', type: 'integer', example: 100),
        new OAT\Property(property: 'total_pages', type: 'integer', example: 10),
    ],
    type: 'object'
)]
final class PaginationMeta {}
