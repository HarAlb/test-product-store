<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\App\Http\Controllers\OrderController;

Route::get('', [OrderController::class, 'index']);
Route::post('', [OrderController::class, 'store']);
