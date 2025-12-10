<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    /**
     * Show Account Settings Page
     */
    public function index()
    {
        $user = Auth::user();
        return view('backend.pengaturan.index', compact('user'));
    }

    /**
     * Update Account Settings
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed', 
        ]);

        // Update basic info
        $user->name  = $request->name;
        $user->email = $request->email;

        // Jika password diisi, update
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Pengaturan akun berhasil diperbarui!');
    }
}
