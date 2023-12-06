<?php

use App\Http\Controllers\ItemController;
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

Route::get('/', [ItemController::class, 'index']);
Route::get('/add-data', [ItemController::class, 'add']);
Route::get('/get/item/{kode_barang}', [ItemController::class, 'show']);

Route::post('/get-item', [ItemController::class, 'getItem']);
Route::post('/add', [ItemController::class, 'postData']);

// Route::post('/ignore', [ItemController::class, 'ignore']);

Route::delete('/delete-data/{id}', [ItemController::class, 'delete']);

Route::patch('/update/{kode_barang}', [ItemController::class, 'update']);


