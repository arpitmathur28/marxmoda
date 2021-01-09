<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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

Route::get('/process/{paymentID}/{token}/{payerID}/{pid}', [PaymentController::class, 'process']);
Route::get('/success/{id}', [PaymentController::class, 'status']);
Route::get('/failed', function ($error = null) {
    return view('failed')->with(["errors" => $error]);
});
Route::get('/load', function () {
    return view('app');
});
Route::get('/{invoice}', [PaymentController::class, 'checkout']);
