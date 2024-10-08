<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\WorkerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
    Route::patch('/orders/{orderId}/assign', [OrderController::class, 'assignWorker']);

    Route::get('/workers/filter', [WorkerController::class, 'filterByOrderTypes']);
});
