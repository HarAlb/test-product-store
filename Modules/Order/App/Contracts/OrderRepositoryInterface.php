<?php

namespace Modules\Order\App\Contracts;

use Illuminate\Support\Collection;
use Modules\Order\App\Application\OrderData;
use Modules\Order\App\Application\OrderFilter;
use Modules\Order\App\Application\OrderResult;

interface OrderRepositoryInterface
{
    public function paginate(int $page, int $perPage, ?OrderFilter $filter = null): Collection;

    public function countAll(?OrderFilter $filter = null): int;

    public function store(OrderData $data): OrderResult;

    public function updateTotalPrice(int $id, float $totalPrice): void;
}
