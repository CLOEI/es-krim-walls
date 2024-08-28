<?php

namespace App\Http\Controllers;

use App\Models\ProductOut;
use Illuminate\Http\Request;

class ProductOutController extends Controller
{
    public function show()
    {
        $products = ProductOut::all();
        return view('daftar_barang_keluar', compact('products'));
    }
}
