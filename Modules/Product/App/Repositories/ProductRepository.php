<?php

namespace Modules\Product\App\Repositories;

use Illuminate\Support\Collection;
use Modules\Product\App\Application\ProductFilter;
use Modules\Product\App\Application\ProductResult;
use Modules\Product\App\Contracts\ProductQueryFilterInterface;
use Modules\Product\App\Contracts\ProductRepositoryInterface;
use Modules\Product\App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(private ProductQueryFilterInterface $filter) {}

    public function paginate(int $page, int $perPage, ?ProductFilter $filter = null): Collection
    {
        $query = Product::query()->with('currency', 'category');

        if ($filter) {
            $this->filter->apply($query, $filter);
        }

        return $query->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get()
            ->map(fn ($model) => ProductResult::fromModel($model));
    }

    public function countAll(?ProductFilter $filter = null): int
    {
        $query = Product::query();

        if ($filter) {
            $this->filter->apply($query, $filter);
        }

        return $query->count();
    }
}
