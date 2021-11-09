<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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


Route::get('/Category', function () {  return view('admin.Category.index');});
Route::get('/Category/add', [CategoryController::class, 'create']);
Route::post('/Category/add', [CategoryController::class, 'store']);
Route::get('/Category/edit/{id}', [CategoryController::class, 'edit']);
Route::put('/Category/edit/{id}', [CategoryController::class, 'update']);
Route::delete('/Category/{id}', [CategoryController::class, 'destroy']);
Route::get('Category/list', [CategoryController::class, 'getCategory']);
