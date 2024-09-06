<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOut;
use App\Models\Stall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductOutController extends Controller
{
    public function show()
    {
        $products_out = ProductOut::all();
        $products = Product::all();
        $stalls = Stall::all();
        return view('daftar_barang_keluar', compact('products', 'products_out', 'stalls'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'stall_id' => 'required|exists:stalls,id',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->products as $product) {
                $stockProduct = Product::find($product['product_id']);
                if ($stockProduct->stock->quantity < $product['quantity']) {
                    return redirect()->route('daftar_barang_keluar')->with('error', 'Stock is not enough');
                }

                ProductOut::create([
                    'products_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'stalls_id' => $request->stall_id,
                    'date' => now(),
                ]);

                $stockProduct->stock->quantity -= $product['quantity'];
                $stockProduct->stock->save();
            }
            DB::commit();
            return redirect()->route('daftar_barang_keluar')->with('success', 'Products Out created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create products out: ' . $e->getMessage());
            return redirect()->route('daftar_barang_keluar')->with('error', $e->getMessage());
        }
    }

    public function remove($id)
    {
        DB::BeginTransaction();
        try {
            $product_out = ProductOut::find($id);
            $product = Product::find($product_out->products_id);
            $product->stock->quantity += $product_out->quantity;
            $product->stock->save();
            $product_out->delete();
            DB::commit();
            return redirect()->route('daftar_barang_keluar')->with('success', 'Product Out removed successfully');
        } catch (\Exception $e) {
            Log::error('Failed to remove product out: ' . $e->getMessage());
            return redirect()->route('daftar_barang_keluar')->with('error', 'Product Out failed to remove');
        }
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'stall_id' => 'required|exists:stalls,id',
            'date' => 'required|date',
        ]);

        DB::BeginTransaction();
        try {
            $product_out = ProductOut::find($id);
            $product = Product::find($product_out->products_id);
            $product->stock->quantity += $product_out->quantity;
            $product->stock->quantity -= $request->quantity;
            $product_out->update([
                'products_id' => $request->product_id,
                'quantity' => $request->quantity,
                'stalls_id' => $request->stall_id,
                'date' => $request->date,
            ]);
            $product_out->save();
            $product->stock->save();
            DB::commit();
            return redirect()->route('daftar_barang_keluar')->with('success', 'Product Out updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to update product out: ' . $e->getMessage());
            return redirect()->route('daftar_barang_keluar')->with('error', 'Product Out failed to update');
        }
    }
}
