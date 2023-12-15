<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/create',[CrudController::class,'create']);
Route::get('/get',[CrudController::class,'get']);
Route::patch('/edit/{id}',[CrudController::class,'edit']);
Route::post('/update/{id}',[CrudController::class,'update']);
Route::delete('/delete/{id}',[CrudController::class,'delete']);