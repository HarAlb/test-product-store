<?php

namespace Modules\Order\App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Modules\Order\App\Application\OrderFilter;

interface OrderQueryFilterInterface
{
    public function apply(Builder $query, OrderFilter $filter): Builder;
}
