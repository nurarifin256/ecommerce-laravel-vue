<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductImportController;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductImportController::class, 'index'])->name('products.import.index');
Route::post('/store', [ProductImportController::class, 'store'])->name('products.import.store');

Route::get('send-email', function () {
    $email = new SendEmail();
    Mail::to('nur.arifin@adis.co.id')->send($email);

    return 'success';
});

Route::get('send-email-v2', function () {
    $data['email'] = 'arifinnur402@gmail.com';

    dispatch(new SendEmailJob($data));

    return 'success';
});

Route::get('send-email-pdf', [PdfController::class, 'index']);
Route::get('send-email-excel', [ExcelController::class, 'index']);
