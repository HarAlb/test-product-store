<?php

namespace Modules\OrderItem\App\Contracts;

use Illuminate\Support\Collection;

interface OrderItemRepositoryInterface
{
    public function storeMultiple(array $data): Collection;
}
