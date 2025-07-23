<?php

namespace Modules\Product\App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Modules\Product\App\Application\ProductFilter;
use Modules\Product\App\Contracts\ProductQueryFilterInterface;

class ProductQueryFilter implements ProductQueryFilterInterface
{
    public function apply(Builder $query, ProductFilter $filter): Builder
    {
        if ($filter->search !== null) {
            $search = '%'.$filter->search.'%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', $search)
                    ->orWhere('description', 'LIKE', $search);
            });
        }

        return $query;
    }
}
