@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Daftar Barang</h1>
        <div class="w-100 d-flex align-items-center gap-2 mb-4">
            <form action="{{ route('barang.index') }}" method="GET" class="d-flex w-100 gap-2">
                <input type="text" name="search" value="{{ $search }}" class="px-2 form-control"
                    style="width: 93%;height: 40px;" placeholder="search">
                <button class="btn btn-outline-success" style="height: 40px" type="submit">Search</button>
            </form>
            <a class="btn btn-outline-primary" style="height: 40px" href="{{ route('actionCreateBarang') }}">Create</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barang as $index => $b)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $b->nama_barang }}</td>
                        <td>{{ $b->jumlah }}</td>
                        <td>{{ number_format($b->harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') }}</td>
                        <td width='15%' class="text-center">
                            <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('barang.destroy', $b->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button onclick="return confirm('Yakin ingin hapus barang ini?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
