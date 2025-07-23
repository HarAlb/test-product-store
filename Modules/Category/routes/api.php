<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

Route::get('', CategoryController::class);
