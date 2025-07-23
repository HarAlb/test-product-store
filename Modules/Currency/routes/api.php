<?php

use Illuminate\Support\Facades\Route;
use Modules\Currency\App\Http\Controllers\CurrencyController;

Route::get('', CurrencyController::class);
