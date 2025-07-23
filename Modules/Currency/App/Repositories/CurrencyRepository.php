<?php

namespace Modules\Currency\App\Repositories;

use Illuminate\Support\Collection;
use Modules\Currency\App\Application\CurrencyResult;
use Modules\Currency\App\Contracts\CurrencyRepositoryInterface;
use Modules\Currency\App\Models\Currency;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function all(): Collection
    {
        return Currency::query()->get()->map(fn ($item) => CurrencyResult::fromModel($item));
    }
}
