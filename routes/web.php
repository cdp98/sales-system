<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;

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

Route::get('/new-sale', [SalesController::class, 'products'])->name('new-sale');
Route::get('/sales', [SalesController::class, 'index'])->name('index');
Route::post('/get-address', [SalesController::class, 'getCep'])->name('get-cep');
Route::post('/save-sale', [SalesController::class, 'newSale'])->name('save-sale');
