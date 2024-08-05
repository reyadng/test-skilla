<?php

use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->get('/test', [TestController::class, 'index']);
