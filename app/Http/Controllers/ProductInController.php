<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use App\Models\Stall;
use Illuminate\Http\Request;

class ProductInController extends Controller
{
    public function show()
    {
        $products_in = ProductIn::all();
        $products = Product::all();
        $stalls = Stall::all();
        return view('daftar_barang_masuk', compact('products', 'products_in', 'stalls'));
    }
}
