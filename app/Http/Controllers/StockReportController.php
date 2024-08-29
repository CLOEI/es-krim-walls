<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function show() {
        $products = ProductIn::all();
        return view('laporan_stok', compact('products'));
    }

    public function getProducts(Request $request) {

        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');

        $products = ProductIn::whereBetween('date', [$fromDate, $toDate])
            ->with(['product.stock', 'product.price'])
            ->get();

        return response()->json(['products' => $products]);
    }

    public function print(Request $request) {
        return view('cetak.cetak_laporan_stok');
    }
}
