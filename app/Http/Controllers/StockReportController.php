<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function show() {
        return view('laporan_stok');
    }
}
