<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}/orders', [CustomerController::class, 'orders']);
Route::post('/orders', [OrderController::class, 'store']);
