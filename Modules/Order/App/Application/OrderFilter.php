<?php

namespace Modules\Order\App\Application;

class OrderFilter
{
    public function __construct(
        public ?int $userId = null,
        public ?string $search = null,
        public ?string $status = null,
    ) {}
}
