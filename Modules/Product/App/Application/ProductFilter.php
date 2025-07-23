<?php

namespace Modules\Product\App\Application;

class ProductFilter
{
    public function __construct(
        public ?string $search = null,
    ) {}
}
