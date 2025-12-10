<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galery = Galery::where('status', '!=', 'menunggu')->orderBy('created_at', 'desc')->paginate(10);
        return view('backend.galery.index', compact('galery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.galery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'deskripsi' => 'required|string',
            'status'    => 'required|in:aktif,menunggu,ditolak,draft',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload Gambar
        $gambarName = time().'_'.$request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move(public_path('uploads/galery'), $gambarName);

        Galery::create([
            'judul'     => $request->judul,
            'tanggal'   => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status,
            'gambar'    => 'uploads/galery/' . $gambarName,
            'user_id'   => Auth::id() ?? null,
        ]);

        return redirect()->route('galery.index')->with('success', 'Galery berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $galery = Galery::findOrFail($id);
        return view('backend.galery.edit', compact('galery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $galery = Galery::findOrFail($id);

        $request->validate([
            'judul'     => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'deskripsi' => 'required|string',
            'status'    => 'required|in:aktif,menunggu,ditolak,draft',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul'     => $request->judul,
            'tanggal'   => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status,
        ];

        // Jika ada gambar baru diupload
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if ($galery->gambar && File::exists(public_path($galery->gambar))) {
                File::delete(public_path($galery->gambar));
            }

            $gambarName = time().'_'.$request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads/galery'), $gambarName);

            $data['gambar'] = 'uploads/galery/' . $gambarName;
        }

        $galery->update($data);

        return redirect()->route('galery.index')->with('success', 'Galery berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $galery = Galery::findOrFail($id);

        // Hapus file gambar
        if ($galery->gambar && File::exists(public_path($galery->gambar))) {
            File::delete(public_path($galery->gambar));
        }

        $galery->delete();

        return redirect()->route('galery.index')->with('success', 'Galery berhasil dihapus!');
    }
}
