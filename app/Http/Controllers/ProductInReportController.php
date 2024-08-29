<?php

namespace App\Http\Controllers;

use App\Models\ProductIn;
use Illuminate\Http\Request;

class ProductInReportController extends Controller
{
    public function show() {
        return view('laporan_barang_masuk');
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
        return view('cetak.cetak_laporan_barang_masuk');
    }
}
