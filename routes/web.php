<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

Route::resource('products', ProductController::class);
Route::resource('clientes', ClienteController::class);
