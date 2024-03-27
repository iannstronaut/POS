<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\userController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;


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

Route::get('/level', [LevelController::class, 'index']);

Route::get('/kategori' , [KategoriController::class, 'index']);

Route::get('/user', 'POSController@index')->name('user.index');

Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [ProductController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductController::class, 'babyKid']);
});

Route::get('/user/{id}/name/{name}', [userController::class, 'user']);

Route::get('/penjualan', [Controller::class, 'penjualan']);


Route::post('/user/tambah_simpan', [userController::class, 'tambah_simpan']);

Route::get('/user/ubah/{id}', [userController::class, 'ubah']);

Route::put('user/ubah_simpan/{id}', [userController::class, 'ubah_simpan']);

Route::get('/user/hapus/{id}', [userController::class, 'hapus']);

Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori', [KategoriController::class, 'store']);

Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
// routes/web.php
Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
Route::get('/kategori/delete/{id}', [KategoriController::class, 'showdel']);
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'delete']);

Route::get('/form', function(){
    return view('form');
});
Route::get('/user/create', function(){
    return view('user.create');
});
Route::get('/level/create', function(){
    return view('level.create');
});

Route::resource('user', POSController::class);