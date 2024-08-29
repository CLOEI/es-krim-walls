<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductInReportController extends Controller
{
    public function show() {
        return view('laporan_barang_masuk');
    }
}
