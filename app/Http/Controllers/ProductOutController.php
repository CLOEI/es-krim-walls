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
            'products.*.carton' => 'required|numeric',
            'products.*.piece' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->products as $product) {
                $stockProduct = Product::find($product['product_id']);
                $total_quantity = $product['carton'] * $stockProduct->ppc + $product['piece'];

                if ($stockProduct->stock->quantity < $total_quantity) {
                    return redirect()->route('daftar_barang_keluar')->with('error', 'Stock is not enough');
                }

                ProductOut::create([
                    'products_id' => $product['product_id'],
                    'carton' => $product['carton'],
                    'pcs' => $product['piece'],
                    'stalls_id' => $request->stall_id,
                    'date' => now(),
                ]);

                $stockProduct->stock->quantity -= $total_quantity;
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
        DB::beginTransaction();
        try {
            $product_out = ProductOut::find($id);
            $product = Product::find($product_out->products_id);
            $total_quantity = $product_out->carton * $product->ppc + $product_out->pcs;

            $product->stock->quantity += $total_quantity;
            $product->stock->save();

            $product_out->delete();

            DB::commit();
            return redirect()->route('daftar_barang_keluar')->with('success', 'Product Out removed successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to remove product out: ' . $e->getMessage());
            return redirect()->route('daftar_barang_keluar')->with('error', 'Product Out failed to remove');
        }
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'carton' => 'required|numeric',
            'piece' => 'required|numeric',
            'stall_id' => 'required|exists:stalls,id',
            'date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $product_out = ProductOut::find($id);
            $product = Product::find($product_out->products_id);

            // Calculate new total quantity
            $new_total_quantity = $request->carton * $product->ppc + $request->piece;
            $old_total_quantity = $product_out->carton * $product->ppc + $product_out->pcs;

            // Update stock
            $product->stock->quantity += $old_total_quantity; // Add old total quantity back to stock
            $product->stock->quantity -= $new_total_quantity; // Subtract new total quantity from stock

            // Update product out record
            $product_out->update([
                'products_id' => $request->product_id,
                'carton' => $request->carton,
                'pcs' => $request->piece,
                'stalls_id' => $request->stall_id,
                'date' => $request->date,
            ]);

            $product->stock->save();
            DB::commit();
            return redirect()->route('daftar_barang_keluar')->with('success', 'Product Out updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update product out: ' . $e->getMessage());
            return redirect()->route('daftar_barang_keluar')->with('error', 'Product Out failed to update');
        }
    }
}
