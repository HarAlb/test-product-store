<?php

namespace Modules\OrderItem\App\Repositories;

use Illuminate\Support\Collection;
use Modules\OrderItem\App\Application\OrderItemData;
use Modules\OrderItem\App\Application\OrderItemResult;
use Modules\OrderItem\App\Contracts\OrderItemRepositoryInterface;
use Modules\OrderItem\App\Models\OrderItem;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    /**
     * @param  OrderItemData[]  $data
     */
    public function storeMultiple(array $data): Collection
    {
        $createdItems = collect();

        foreach ($data as $itemData) {
            if ($itemData->orderId === null) {
                throw new \InvalidArgumentException('OrderId is required');
            }

            $createdItems->push(
                OrderItem::create([
                    'order_id' => $itemData->orderId,
                    'product_id' => $itemData->productId,
                    'quantity' => $itemData->quantity,
                    'price' => $itemData->price,
                    'discount' => $itemData->discount ?? 0,
                ])->load('product')
            );
        }

        return $createdItems->map(fn ($item) => OrderItemResult::fromModel($item));
    }
}
