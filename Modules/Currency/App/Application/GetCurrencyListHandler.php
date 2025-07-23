<?php

namespace Modules\Currency\App\Application;

use Illuminate\Support\Collection;
use Modules\Currency\App\Contracts\CurrencyRepositoryInterface;

class GetCurrencyListHandler
{
    public function __construct(
        private readonly CurrencyRepositoryInterface $repository
    ) {}

    public function handle(): Collection
    {
        return $this->repository->all();
    }
}
