<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Páginas UI de demostración
Route::get('/ui', function () { return view('ui.index'); });
Route::get('/ui/mesas', function () { return view('ui.mesas'); });
Route::get('/ui/insumos', function () { return view('ui.insumos'); });
Route::get('/ui/pedidos', function () { return view('ui.pedidos'); });
