<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/addProduct', function () {
    return view('addproduct');
});

Route::get('/list',[productController::class,'get']);

Route::post('/add',[productController::class,'add']);

Route::get('/delete/{id}',[productController::class,'delete']);

Route::get('/update/{id}',[productController::class,'update']);

Route::post('/update_data/{id}',[productController::class,'update_data']);