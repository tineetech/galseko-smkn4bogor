<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;

class VerifikasiGaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galery = Galery::where('status', 'menunggu')->orderBy('created_at', 'desc')->paginate(10);
        return view('backend.galery.verifikasi', compact('galery'));
    }

    public function verifikasi($id)
    {
        $galery = Galery::findOrFail($id);
        $galery->status = 'aktif';
        $galery->save();

        return redirect()->back()->with('success', 'Galery berhasil diverifikasi!');
    }

    public function tolak($id)
    {
        $galery = Galery::findOrFail($id);
        $galery->status = 'ditolak';
        $galery->save();

        return redirect()->back()->with('success', 'Galery berhasil ditolak!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
