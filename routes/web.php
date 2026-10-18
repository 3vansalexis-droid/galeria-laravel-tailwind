<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'updateCategoria'])->name('categorias.update');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'deleteCategoiria'])->name('categorias.destroy');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
Route::resource('clientes', ClienteController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('ventas', VentaController::class)->only(['index', 'store', 'update', 'destroy']);
