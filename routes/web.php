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

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/logout", [AuthController::class, 'logout'])->name('logout');
    Route::get('/daftar_barang', "App\Http\Controllers\ProductController@show")->name('daftar_barang');
    Route::post('/daftar_barang', "App\Http\Controllers\ProductController@create")->name('tambah_barang');
    Route::put('/daftar_barang/{id}', "App\Http\Controllers\ProductController@edit")->name('edit_barang');
    Route::delete('/daftar_barang/{id}', "App\Http\Controllers\ProductController@remove")->name('remove_barang');

    Route::get('/daftar_barang_keluar', "App\Http\Controllers\ProductOutController@show")->name('daftar_barang_keluar');
    Route::post('/daftar_barang_keluar', "App\Http\Controllers\ProductOutController@create")->name('tambah_daftar_barang_keluar');
    Route::put('/daftar_barang_keluar/{id}', "App\Http\Controllers\ProductOutController@edit")->name('edit_daftar_barang_keluar');
    Route::delete('/daftar_barang_keluar/{id}', "App\Http\Controllers\ProductOutController@remove")->name('remove_daftar_barang_keluar');

    Route::get('/daftar_barang_masuk', "App\Http\Controllers\ProductInController@show")->name('daftar_barang_masuk');
    Route::post('/daftar_barang_masuk', "App\Http\Controllers\ProductInController@create")->name('tambah_daftar_barang_masuk');
    Route::put('/daftar_barang_masuk/{id}', "App\Http\Controllers\ProductInController@edit")->name('edit_daftar_barang_masuk');
    Route::delete('/daftar_barang_masuk/{id}', "App\Http\Controllers\ProductInController@remove")->name('remove_daftar_barang_masuk');


    Route::get('/tambah_outlet', "App\Http\Controllers\StallController@show")->name('tambah_outlet');
    Route::post('/tambah_outlet', "App\Http\Controllers\StallController@create")->name('tambah_outlet');

    Route::get('/tambah_produk', "App\Http\Controllers\ProductController@add_show")->name('tambah_produk');
    Route::post('/tambah_produk', "App\Http\Controllers\ProductController@create")->name('tambah_produk');

    Route::get('/laporan_stok', "App\Http\Controllers\StockReportController@show")->name('laporan_stok');
    Route::get('/get-products', "App\Http\Controllers\StockReportController@getProducts");
    Route::get('/cetak_laporan_stok', "App\Http\Controllers\StockReportController@print")->name('cetak_laporan_stok');

    Route::get('/laporan_barang_keluar', "App\Http\Controllers\ProductOutReportController@show")->name('laporan_barang_keluar');
    Route::get('/laporan_barang_masuk', "App\Http\Controllers\ProductInReportController@show")->name('laporan_barang_masuk');

});

