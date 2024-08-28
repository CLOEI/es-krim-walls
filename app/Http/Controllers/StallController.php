<?php

namespace App\Http\Controllers;

use App\Models\Stall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StallController extends Controller
{
    public function show()
    {
        return view('tambah_outlet');
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
