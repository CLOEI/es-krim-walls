<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use App\Models\ProductOut;
use App\Models\Stock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        // get products count, Producin count,  productout count
        $productsCount = Product::all()->count();
        $productsInCount = ProductIn::all()->count();
        $productsOutCount = ProductOut::all()->count();
        $currentStockQuantity = Stock::all()->sum('quantity');

        return view('app', compact('productsCount', 'productsInCount', 'productsOutCount', 'currentStockQuantity'));
    }
}
