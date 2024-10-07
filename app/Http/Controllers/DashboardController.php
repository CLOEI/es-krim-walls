<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use App\Models\ProductOut;
use App\Models\Stock;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function show()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $productsCount = Product::all()->count();
        $productsInCount = ProductIn::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $productsOutCount = ProductOut::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $currentStockQuantity = Product::all()->sum(function ($product) {
            return $product->stock->carton * $product->ppc + $product->stock->piece;
        });
        $averageDailyStatistics = ProductOut::selectRaw('AVG(items_gone) as average_items_gone')
            ->fromSub(function ($query) {
                $query->selectRaw('date, COUNT(*) as items_gone')
                    ->from('product_out')
                    ->groupBy('date');
            }, 'daily_counts')
            ->first();

        return view('app', compact('productsCount', 'productsInCount', 'productsOutCount', 'currentStockQuantity', 'averageDailyStatistics'));
    }
}
