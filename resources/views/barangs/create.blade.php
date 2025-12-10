@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Buat Barang</h1>
        {{-- Gunakan POST + route yang benar --}}
        <form action="{{ route('actionCreateBarang') }}" method="POST">
            @csrf
            <div class="row row-cols-2 g-3">
                <div class="col">
                    <span class="">Nama Barang</span>
                    <input type="text" name="nama_barang" placeholder="Masukan Nama barang.." class="form-control mt-2" required>
                </div>
                <div class="col">
                    <span class="">Jumlah</span>
                    <input type="number" name="jumlah" placeholder="Masukan Jumlah barang.." class="form-control mt-2" required>
                </div>
                <div class="col">
                    <span class="">Harga</span>
                    <input type="number" name="harga" placeholder="Masukan Harga barang.." class="form-control mt-2" required>
                </div>
                <div class="col">
                    <span class="">Tanggal</span>
                    <input type="date" name="tanggal" placeholder="Masukan Tanggal pembuatan barang.." class="form-control mt-2" required>
                </div>
            </div>
            <div class="row mt-3 g-3 row-cols-2">
                <div class="col">
                    <a href="/barang" class="btn w-100 btn-secondary">Cancel</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn w-100 btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
