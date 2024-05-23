<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\MenuController;
use App\Http\Controllers\api\ReservaController;
use App\Http\Controllers\api\PedidoController;
use App\Http\Controllers\api\ClienteController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
Route::get('/menus', [MenuController::class, 'index'])->name('menus');
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');

Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas');
Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
Route::get('/reservas/{reserva}', [ReservaController::class, 'show'])->name('reservas.show');
Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');

Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos');
Route::delete('/pedidos/{pedido}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
Route::put('/pedidos/{pedido}', [PedidoController::class, 'update'])->name('pedidos.update');

Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');