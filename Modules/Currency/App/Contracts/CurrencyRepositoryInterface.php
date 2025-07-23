<?php

namespace Modules\Currency\App\Contracts;

use Illuminate\Support\Collection;

interface CurrencyRepositoryInterface
{
    public function all(): Collection;
}
