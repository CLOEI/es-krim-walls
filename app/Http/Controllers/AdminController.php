<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function show()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin', compact('users'));
    }

    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'sex' => 'required|string|max:10',
            'photo_url' => 'nullable|string|max:255',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'sex' => $validatedData['sex'] ?? null,
            'photo_url' => "https://api.dicebear.com/9.x/Lorelei/svg?seed=" . $validatedData['first_name'] . $validatedData['last_name'],
            'password' => $validatedData['password'],
        ]);

        $user->assignRole('admin');

        return redirect()->route('admin')->with('success', 'Admin created successfully.');
    }

    public function remove($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin')->with('success', 'Admin deleted successfully.');
    }
}
