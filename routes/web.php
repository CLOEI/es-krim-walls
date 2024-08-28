<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\DashboardController@show")->name('app')->middleware('auth:sanctum');

Route::get("/login", function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get("/logout", [AuthController::class, 'logout'])->name('logout');

Route::get('/daftar_barang', "App\Http\Controllers\ProductController@show")->name('daftar_barang');
Route::post('/barang', "App\Http\Controllers\ProductController@create")->name('tambah_barang');
Route::put('/barang/{id}', "App\Http\Controllers\ProductController@edit")->name('edit_barang');
Route::delete('/barang/{id}', "App\Http\Controllers\ProductController@remove")->name('remove_barang');
