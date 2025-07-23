<?php

namespace Modules\Order\App\Application;

use Modules\Order\App\Contracts\OrderRepositoryInterface;
use Modules\Shared\App\Application\PaginatedList;

class GetOrderPaginateHandler
{
    public function __construct(private readonly OrderRepositoryInterface $repository) {}

    public function handle(int $page = 1, int $perPage = 10, ?OrderFilter $filter = null): PaginatedList
    {
        $orders = $this->repository->paginate($page, $perPage, $filter);

        $countAll = $this->repository->countAll($filter);

        return new PaginatedList(
            data: $orders->toArray(),
            total: $countAll,
            page: $page,
            perPage: $perPage
        );
    }
}
