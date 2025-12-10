<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $galeri = Galery::where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('home.index', compact('galeri'));
    }

    public function upload()
    {
        $galeri = Galery::where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('home.upload', compact('galeri'));
    }
    
    public function uploadGaleri(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        // Upload file
        $file = $request->file('image');
        $filename = time() . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/galeri/'), $filename);

        // Simpan ke database
        Galery::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'uploads/galeri/' . $filename,
            'status' => 'menunggu', // default
        ]);

        return back()->with('success', 'Galeri berhasil diunggah! Menunggu verifikasi admin.');
    }
}
