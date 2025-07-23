<?php

namespace Modules\Order\App\Application;

use Illuminate\Support\Facades\DB;
use Modules\Order\App\Contracts\OrderRepositoryInterface;
use Modules\OrderItem\App\Application\OrderItemResult;
use Modules\OrderItem\App\Contracts\OrderItemRepositoryInterface;
use Modules\Product\App\Application\ProductResult;
use Modules\Product\App\Repositories\ProductRepository;

class StoreOrderHandler
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly OrderItemRepositoryInterface $orderItemRepository,
        private readonly ProductRepository $productRepository,
    ) {}

    public function handle(OrderData $data): OrderResult
    {
        $products = $this->productRepository->getByIds(
            array_map(fn ($item) => $item->productId, $data->items)
        )->keyBy(fn ($item) => $item->getId());

        return DB::transaction(function () use ($data, $products) {
            /** @var OrderResult $order */
            $order = $this->orderRepository->store($data);

            $data->items = array_map(function ($orderItemData) use ($order, $products) {
                /** @var ProductResult $product */
                $product = $products->get($orderItemData->productId);

                if (! $product) {
                    throw new \Exception("Product with ID {$orderItemData->productId} not found");
                }

                return $orderItemData->setOrderId($order->getId())->setPrice($product->getPrice());
            }, $data->items);
            /** @var OrderItemResult[] $items */
            $items = $this->orderItemRepository->storeMultiple(
                $data->items
            );
            /** @var OrderItemResult $item */
            $totalPrice = $items->sum(fn ($item) => ($item->getPrice() * $item->getQuantity()) - ($item->getDiscount() ?? 0));

            $this->orderRepository->updateTotalPrice($order->getId(), $totalPrice);

            $order->setTotalPrice($totalPrice);

            $items->map(function ($item) use ($order) {
                $order->addItem($item);
            });

            return $order;
        });
    }
}
