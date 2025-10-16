<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pedidos\Http\Controllers\HealthController;
use App\Modules\Pedidos\Http\Controllers\PedidoController;

Route::middleware('api')->prefix('api')->group(function () {
    Route::prefix('v1/pedidos')->group(function () {
        Route::get('health', [HealthController::class, 'index']);
        Route::get('', [PedidoController::class, 'index']);
        Route::post('', [PedidoController::class, 'store']);
        Route::put('{id}', [PedidoController::class, 'update']);
        Route::patch('{id}/cerrar', [PedidoController::class, 'cerrar']);
        Route::patch('{id}/abrir', [PedidoController::class, 'abrir']);
        Route::patch('{id}/cancelar', [PedidoController::class, 'cancelar']);
        Route::delete('{id}', [PedidoController::class, 'destroy']);
    });
});