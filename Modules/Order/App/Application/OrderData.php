<?php

namespace Modules\Order\App\Application;

use Modules\OrderItem\App\Application\OrderItemData;

class OrderData
{
    /**
     * @param  OrderItemData[]  $items
     */
    public function __construct(
        public int $userId,
        public array $items,
        public string $status = 'pending',
    ) {}
}
