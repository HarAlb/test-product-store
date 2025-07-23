<?php

namespace Modules\Product\App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Modules\Product\App\Application\ProductFilter;

interface ProductQueryFilterInterface
{
    public function apply(Builder $query, ProductFilter $filter): Builder;
}
