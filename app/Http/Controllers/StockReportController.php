<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function getProducts(Request $request) {

        $products = ProductIn::with(['product.stock', 'product.price'])->get();

        return response()->json(['products' => $products]);
    }

    public function print(Request $request) {
        return view('cetak.cetak_laporan_stok');
    }
}
