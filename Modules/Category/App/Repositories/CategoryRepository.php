<?php

namespace Modules\Category\App\Repositories;

use Illuminate\Support\Collection;
use Modules\Category\App\Application\CategoryResult;
use Modules\Category\App\Contracts\CategoryRepositoryInterface;
use Modules\Category\App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): Collection
    {
        return Category::query()->get()->map(fn ($item) => CategoryResult::fromModel($item));
    }
}
