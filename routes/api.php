<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

Route::apiResource('products', ProductController::class);
Route::apiResource('customers', CustomerController::class);