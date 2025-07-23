<?php

namespace Modules\Product\App\Application;

use Modules\Product\App\Contracts\ProductRepositoryInterface;
use Modules\Shared\App\Application\PaginatedList;

class GetProductPaginateHandler
{
    public function __construct(private readonly ProductRepositoryInterface $repository) {}

    public function handle(int $page = 1, int $perPage = 10, ?ProductFilter $filter = null): PaginatedList
    {
        $products = $this->repository->paginate($page, $perPage, $filter);

        $countAll = $this->repository->countAll($filter);

        return new PaginatedList(
            data: $products->toArray(),
            total: $countAll,
            page: $page,
            perPage: $perPage
        );
    }
}
