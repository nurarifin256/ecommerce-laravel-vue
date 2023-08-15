<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Inventory\BarangController;
use App\Http\Controllers\Api\People\SaveController;
use App\Http\Controllers\Api\Permission\PermissionController;
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

Route::post('/people/save', [SaveController::class, 'save']);

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::apiResource('/permissions', PermissionController::class);

Route::get('/inventory/barang', [BarangController::class, 'getBarangs']);
Route::get('/inventory/barang/cari/{search}', [BarangController::class, 'cari']);
Route::post('/inventory/list', [BarangController::class, 'data_list']);
Route::post('/inventory/list_2', [BarangController::class, 'data_list2']);
Route::get('/inventory/barang/search', [BarangController::class, 'search']);
Route::get('/inventory', [BarangController::class, 'index']);
// Route::get('/sql-server', [BarangController::class, 'getCategories']);
Route::get('/sql-server/{id}', [BarangController::class, 'getCategories']);

Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout']);
