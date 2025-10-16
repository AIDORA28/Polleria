<?php

use Illuminate\Support\Facades\Route;
use App\Modules\_ModuleTemplate\Http\Controllers\HealthController;

Route::middleware('api')->prefix('api')->group(function () {
    Route::prefix('v1/template')->group(function () {
        Route::get('health', [HealthController::class, 'index']);
    });
});