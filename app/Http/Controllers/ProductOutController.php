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
            'product_id' => 'required|exists:products,id',
            'carton' => 'required|numeric',
            'piece' => 'required|numeric',
            'date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::find($request->product_id);
            $total_quantity = $request->carton * $product->ppc + $request->piece;

            $stock = $product->stock;
            $current_total_quantity = $stock->carton * $product->ppc + $stock->piece;

            // Check if stock is sufficient
            if ($total_quantity > $current_total_quantity) {
                return redirect()->route('daftar_barang_masuk')->with('error', 'Insufficient stock to create Product Out');
            }

            ProductOut::create([
                'products_id' => $request->product_id,
                'carton' => $request->carton,
                'pcs' => $request->piece,
                'date' => $request->date,
            ]);

            $stock->carton -= $request->carton;
            $stock->piece -= $request->piece;

            // Normalize stock if pieces are negative
            if ($stock->piece < 0) {
                $missing_cartons = intdiv(abs($stock->piece), $product->ppc) + 1;
                $stock->carton -= $missing_cartons;
                $stock->piece += $missing_cartons * $product->ppc;
            }

            $stock->save();

            DB::commit();
            return redirect()->route('daftar_barang_masuk')->with('success', 'Product Out created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create product out: ' . $e->getMessage());
            return redirect()->route('daftar_barang_masuk')->with('error', 'Product Out failed to create');
        }
    }

    public function remove($id)
    {
        DB::beginTransaction();
        try {
            $product_out = ProductOut::find($id);
            $product = Product::find($product_out->products_id);

            $product->stock->carton += $product_out->carton;
            $product->stock->piece += $product_out->pcs;

            // Normalize stock if pieces exceed pieces per carton
            if ($product->stock->piece >= $product->ppc) {
                $additional_cartons = intdiv($product->stock->piece, $product->ppc);
                $product->stock->carton += $additional_cartons;
                $product->stock->piece = $product->stock->piece % $product->ppc;
            }

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

            $product->stock->carton -= $product_out->carton;
            $product->stock->piece -= $product_out->pcs;

            $product->stock->carton += $request->carton;
            $product->stock->piece += $request->piece;

            // Normalize stock if pieces are negative
            if ($product->stock->piece < 0) {
                $missing_cartons = intdiv(abs($product->stock->piece), $product->ppc) + 1;
                $product->stock->carton -= $missing_cartons;
                $product->stock->piece += $missing_cartons * $product->ppc;
            }

            $product->stock->save();

            // Update product out record
            $product_out->update([
                'products_id' => $request->product_id,
                'carton' => $request->carton,
                'pcs' => $request->piece,
                'stalls_id' => $request->stall_id,
                'date' => $request->date,
            ]);

            DB::commit();
            return redirect()->route('daftar_barang_keluar')->with('success', 'Product Out updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update product out: ' . $e->getMessage());
            return redirect()->route('daftar_barang_keluar')->with('error', 'Product Out failed to update');
        }
    }
}
