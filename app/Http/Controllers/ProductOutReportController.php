<?php

namespace App\Http\Controllers;

use App\Models\ProductOut;
use Illuminate\Http\Request;

class ProductOutReportController extends Controller
{
    public function show() {
        return view('laporan_barang_keluar');
    }
}
