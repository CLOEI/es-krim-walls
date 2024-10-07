<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use App\Models\Stall;
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
            'carton' => 'required|numeric',
            'piece' => 'required|numeric',
            'date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::find($request->product_id);

            ProductIn::create([
                'products_id' => $request->product_id,
                'carton' => $request->carton,
                'pcs' => $request->piece,
                'date' => $request->date,
            ]);

            $stock = $product->stock;
            $stock->carton += $request->carton;
            $stock->piece += $request->piece;
            $stock->save();

            DB::commit();
            return redirect()->route('daftar_barang_masuk')->with('success', 'Product In created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create product in: ' . $e->getMessage());
            return redirect()->route('daftar_barang_masuk')->with('error', 'Product In failed to create');
        }
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'carton' => 'required|numeric',
            'piece' => 'required|numeric',
            'date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $product_in = ProductIn::find($id);
            $product = Product::find($product_in->products_id);;

            $product->stock->carton -= $product_in->carton;
            $product->stock->piece -= $product_in->pcs;
            $product->stock->carton += $request->carton;
            $product->stock->piece += $request->piece;
            $product->stock->save();
            $product->save();

            $product_in->update([
                'products_id' => $request->product_id,
                'carton' => $request->carton,
                'pcs' => $request->piece,
                'date' => $request->date,
            ]);

            DB::commit();
            return redirect()->route('daftar_barang_masuk')->with('success', 'Product In updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update product in: ' . $e->getMessage());
            return redirect()->route('daftar_barang_masuk')->with('error', 'Product In failed to update');
        }
    }

    public function remove($id)
    {
        DB::beginTransaction();
        try {
            $product_in = ProductIn::find($id);
            $product = Product::find($product_in->products_id);


            $product->stock->carton -= $product_in->carton;
            $product->stock->piece -= $product_in->pcs;
            $product->stock->save();

            $product_in->delete();

            DB::commit();
            return redirect()->route('daftar_barang_masuk')->with('success', 'Product In removed successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to remove product in: ' . $e->getMessage());
            return redirect()->route('daftar_barang_masuk')->with('error', 'Product In failed to remove');
        }
    }
}
