<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use App\Models\Stall;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductInController extends Controller
{
    public function show()
    {
        $products_in = ProductIn::all();
        $products = Product::all();
        $stalls = Stall::all();
        return view('daftar_barang_masuk', compact('products', 'products_in', 'stalls'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'date' => 'required|date',
        ]);

        DB::BeginTransaction();
        try {
            ProductIn::create([
                'products_id' => $request->product_id,
                'quantity' => $request->quantity,
                'date' => $request->date,
            ]);

            $stock = Product::find($request->product_id)->stock;
            $stock->quantity += $request->quantity;
            $stock->save();

            DB::commit();
            return redirect()->route('daftar_barang_masuk')->with('success', 'Product In created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create product out: ' . $e->getMessage());
            return redirect()->route('daftar_barang_masuk')->with('error', 'Product In failed to create');
        }
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'date' => 'required|date',
        ]);

        DB::BeginTransaction();
        try {
            $product_in = ProductIn::find($id);
            $old_stock = Product::find($product_in->products_id)->stock;
            $old_stock->quantity -= $product_in->quantity;
            $old_stock->save();

            $product_in->products_id = $request->product_id;
            $product_in->quantity = $request->quantity;
            $product_in->date = $request->date;
            $product_in->save();

            $new_stock = Product::find($request->product_id)->stock;
            $new_stock->quantity += $request->quantity;
            $new_stock->save();


            DB::commit();
            return redirect()->route('daftar_barang_masuk')->with('success', 'Product In updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update product in: ' . $e->getMessage());
            return redirect()->route('daftar_barang_masuk')->with('error', 'Product In failed to update');
        }
    }

    public function remove($id)
    {
        DB::BeginTransaction();
        try {
            $product_in = ProductIn::find($id);
            $stock = Product::find($product_in->products_id)->stock;
            $stock->quantity -= $product_in->quantity;
            $stock->save();
            $product_in->delete();
            DB::commit();
            return redirect()->route('daftar_barang_masuk')->with('success', 'Product In removed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to remove product in: ' . $e->getMessage());
            return redirect()->route('daftar_barang_masuk')->with('error', 'Product In failed to remove');
        }
    }
}
