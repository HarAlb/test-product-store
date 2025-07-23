<?php

namespace Modules\Product\App\Contracts;

use Illuminate\Support\Collection;
use Modules\Product\App\Application\ProductFilter;

interface ProductRepositoryInterface
{
    public function paginate(int $page, int $perPage, ?ProductFilter $filter = null): Collection;

    public function countAll(?ProductFilter $filter = null): int;
}
