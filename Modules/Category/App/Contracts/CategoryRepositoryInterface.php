<?php

namespace Modules\Category\App\Contracts;

use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function all(): Collection;
}
