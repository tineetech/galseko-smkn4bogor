@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Edit Barang</h1>

        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row row-cols-2 g-3">
                <div class="col">
                    <span>Nama Barang</span>
                    <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="form-control mt-2" required>
                </div>
                <div class="col">
                    <span>Jumlah</span>
                    <input type="number" name="jumlah" value="{{ old('jumlah', $barang->jumlah) }}" class="form-control mt-2" required>
                </div>
                <div class="col">
                    <span>Harga</span>
                    <input type="number" name="harga" value="{{ old('harga', $barang->harga) }}" class="form-control mt-2" required>
                </div>
                <div class="col">
                    <span>Tanggal</span>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $barang->tanggal) }}" class="form-control mt-2" required>
                </div>
            </div>

            <div class="row mt-3 g-3 row-cols-2">
                <div class="col">
                    <a href="{{ route('barang.index') }}" class="btn w-100 btn-secondary">Cancel</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn w-100 btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
