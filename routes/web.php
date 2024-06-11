<?php

use App\Http\Controllers\SalesOrderController;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['csrfExempt'])->resource('salesOrder', SalesOrderController::class, [
    'except' => ['create', 'edit']
]);
