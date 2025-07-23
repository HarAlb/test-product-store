<?php

namespace Modules\Order\App\Repositories;

use Illuminate\Support\Collection;
use Modules\Order\App\Application\OrderData;
use Modules\Order\App\Application\OrderFilter;
use Modules\Order\App\Application\OrderResult;
use Modules\Order\App\Contracts\OrderQueryFilterInterface;
use Modules\Order\App\Contracts\OrderRepositoryInterface;
use Modules\Order\App\Models\Order;
use Modules\Product\App\Models\Product;

class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(private OrderQueryFilterInterface $filter) {}

    public function paginate(int $page, int $perPage, ?OrderFilter $filter = null): Collection
    {
        $query = Order::query()->with('items.product');

        if ($filter) {
            $this->filter->apply($query, $filter);
        }

        return $query->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get()
            ->map(fn ($model) => OrderResult::fromModel($model));
    }

    public function countAll(?OrderFilter $filter = null): int
    {
        $query = Product::query();

        if ($filter) {
            $this->filter->apply($query, $filter);
        }

        return $query->count();
    }

    public function store(OrderData $data): OrderResult
    {
        $model = Order::query()->create([
            'user_id' => $data->userId,
            'status' => $data->status,
        ]);

        return OrderResult::fromModel($model);
    }

    public function updateTotalPrice(int $id, float $totalPrice): void
    {
        Order::query()->where('id', $id)->update([
            'total_price' => $totalPrice,
        ]);
    }
}
