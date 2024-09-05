<?php

namespace App\Http\Controllers;

use App\Models\Stall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StallController extends Controller
{
    public function show()
    {
        return view('tambah_outlet');
    }

    public function show_list()
    {
        $stalls = Stall::all();
        return view('daftar_outlet', compact('stalls'));
    }

    public function edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        DB::beginTransaction();

        try {
            Stall::where('id', $id)->update([
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
            ]);

            DB::commit();

            return redirect()->route('daftar_outlet')->with('success', 'Stall updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update stall: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update stall. Please try again.');
        }
    }

    public function remove(Request $request)
    {
        DB::beginTransaction();

        try {
            Stall::where('id', $request->id)->delete();

            DB::commit();

            return redirect()->route('daftar_outlet')->with('success', 'Stall removed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to remove stall: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to remove stall. Please try again.');
        }
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        DB::beginTransaction();

        try {
            Stall::create([
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
            ]);

            DB::commit();

            return redirect()->route('tambah_outlet')->with('success', 'Stall added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create stall: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add stall. Please try again.');
        }
    }
}
