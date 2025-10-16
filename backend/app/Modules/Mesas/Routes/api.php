<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Mesas\Http\Controllers\HealthController;
use App\Modules\Mesas\Http\Controllers\MesaController;

Route::middleware('api')->prefix('api')->group(function () {
    Route::prefix('v1/mesas')->group(function () {
        Route::get('health', [HealthController::class, 'index']);
        Route::get('', [MesaController::class, 'index']);
        Route::post('', [MesaController::class, 'store']);
        Route::put('{id}', [MesaController::class, 'update']);
        Route::delete('{id}', [MesaController::class, 'destroy']);
        Route::patch('{id}/ocupar', [MesaController::class, 'ocupar']);
        Route::patch('{id}/liberar', [MesaController::class, 'liberar']);
    });
});