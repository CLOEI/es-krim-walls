<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function show()
    {
        $products = Product::all();
        return view('daftar_barang', compact('products'));
    }

    public function add_show()
    {
        return view('tambah_produk');
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'barcode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'ppc' => 'required|integer',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $product = Product::create([
                'barcode' => $validatedData['barcode'],
                'ppc' => $validatedData['ppc'],
                'name' => $validatedData['name'],
            ]);

            $stock = Stock::create([
                'carton' => 0,
                'piece' => 0,
                'product_id' => $product->id,
            ]);

            $price = Price::create([
                'purchase_price' => $validatedData['purchase_price'],
                'selling_price' => $validatedData['selling_price'],
                'product_id' => $product->id,
            ]);

            $product->update([
                'stocks_id' => $stock->id,
                'prices_id' => $price->id,
            ]);

            DB::commit();

            return redirect()->route('tambah_produk')->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add product. Please try again.');
        }
    }

    public function edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'barcode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'stock_quantity' => 'required|integer',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $product = Product::find($id);
            $product->update([
                'barcode' => $validatedData['barcode'],
                'name' => $validatedData['name'],
            ]);

            $stock = Stock::find($product->stocks_id);
            $stock->update([
                'carton' => $validatedData['stock_quantity'],
            ]);

            $price = Price::find($product->prices_id);
            $price->update([
                'purchase_price' => $validatedData['purchase_price'],
                'selling_price' => $validatedData['selling_price'],
            ]);

            DB::commit();

            return redirect()->route('daftar_barang')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function remove($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::find($id);
            $product->delete();

            DB::commit();

            return redirect()->route('daftar_barang')->with('success', 'Product removed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to remove product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to remove product. Please try again.');
        }
    }
}
