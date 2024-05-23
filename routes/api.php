<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\MenuController;

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
