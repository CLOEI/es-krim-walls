<?php

namespace App\Http\Controllers;

use App\Models\ProductOut;
use Illuminate\Http\Request;

class ProductOutReportController extends Controller
{
    public function show() {
        return view('laporan_barang_keluar');
    }

    public function getProducts(Request $request) {

        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');

        $products = ProductOut::whereBetween('date', [$fromDate, $toDate])
            ->with(['product.stock', 'product.price', 'stall'])
            ->get();

        return response()->json(['products' => $products]);
    }

    public function print(Request $request) {
        return view('cetak.cetak_laporan_barang_keluar');
    }
}
