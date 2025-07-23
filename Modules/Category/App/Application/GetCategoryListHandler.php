<?php

namespace Modules\Category\App\Application;

use Illuminate\Support\Collection;
use Modules\Category\App\Contracts\CategoryRepositoryInterface;

class GetCategoryListHandler
{
    public function __construct(
        private readonly CategoryRepositoryInterface $repository
    ) {}

    public function handle(): Collection
    {
        return $this->repository->all();
    }
}
