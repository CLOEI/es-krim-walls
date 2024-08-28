<?php

namespace App\Http\Controllers;

use App\Models\ProductIn;
use Illuminate\Http\Request;

class ProductInController extends Controller
{
    public function show()
    {
        $products = ProductIn::all();
        return view('daftar_barang_masuk', compact('products'));
    }
}
