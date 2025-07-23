<?php

namespace Modules\Order\App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Modules\Order\App\Application\OrderFilter;
use Modules\Order\App\Contracts\OrderQueryFilterInterface;

class OrderQueryFilter implements OrderQueryFilterInterface
{
    public function apply(Builder $query, OrderFilter $filter): Builder
    {
        if ($filter->search !== null) {
            $search = '%'.$filter->search.'%';
            $query->where(function ($query) use ($search) {
                $query->whereHas('items.product', function ($q) use ($search) {
                    // Поиск по названию товара в заказе
                    $q->where('name', 'LIKE', $search);
                });
            });
        }

        if (isset($filter->status) && $filter->status) {
            $query->where(function ($q) use ($filter) {
                $q->where('status', $filter->status);
            });
        }

        return $query;
    }
}
