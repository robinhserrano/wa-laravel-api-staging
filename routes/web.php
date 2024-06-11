<?php

use App\Http\Controllers\SalesOrderController;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/salesOrders', [SalesOrderController::class, 'index']);
Route::get('/salesOrders/{salesOrder}', [SalesOrderController::class, 'show']);
Route::middleware('auth:sanctum')->resource('salesOrder', SalesOrderController::class, [
    'except' => ['create', 'edit', 'show', 'index']
]);
