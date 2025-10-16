<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Inventario\Http\Controllers\HealthController;
use App\Modules\Inventario\Http\Controllers\InsumoController;

Route::middleware('api')->prefix('api')->group(function () {
    Route::prefix('v1/inventario')->group(function () {
        Route::get('health', [HealthController::class, 'index']);
        Route::get('insumos', [InsumoController::class, 'index']);
        Route::post('insumos', [InsumoController::class, 'store']);
        Route::put('insumos/{id}', [InsumoController::class, 'update']);
        Route::delete('insumos/{id}', [InsumoController::class, 'destroy']);
        Route::post('insumos/{id}/restore', [InsumoController::class, 'restore']);
    });
});