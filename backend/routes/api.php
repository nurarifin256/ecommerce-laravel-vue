<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Inventory\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/inventory/barang', [BarangController::class, 'getBarangs']);
Route::post('/inventory/list', [BarangController::class, 'data_list']);
Route::get('/inventory/barang/search', [BarangController::class, 'search']);
Route::get('/inventory', [BarangController::class, 'index']);

Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout']);
