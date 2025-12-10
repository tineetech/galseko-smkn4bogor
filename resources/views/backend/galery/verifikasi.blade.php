@extends('layouts.admin')
@section('content')

<!-- Content Header -->
<section class="content-header">
  <h1>
    Verifikasi Galery
    <small>Halaman verifikasi galeri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Verifikasi Galery</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Galeri yang Perlu Diverifikasi</h3>
        </div>

        <div class="box-body table-responsive">

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="50">ID</th>
                <th width="120">Gambar</th>
                <th>Judul</th>
                <th width="120">Tanggal</th>
                <th>Deskripsi</th>
                <th width="100">Status</th>
                <th width="150">Aksi</th>
              </tr>
            </thead>
            <tbody>

              @forelse ($galery as $g)
              <tr>
                <td>{{ $g->id }}</td>

                <td>
                  @if($g->gambar && file_exists(public_path($g->gambar)))
                    <img src="{{ asset($g->gambar) }}" 
                         style="width:100px; height:70px; object-fit:cover;"
                         alt="foto">
                  @else
                    <span class="text-muted">Tidak ada gambar</span>
                  @endif
                </td>

                <td>{{ $g->judul }}</td>

                <td>{{ \Carbon\Carbon::parse($g->tanggal)->format('d/m/Y') }}</td>

                <td>{{ Str::limit($g->deskripsi, 60) }}</td>

                <td>
                  <span class="label label-warning">{{ $g->status }}</span>
                </td>

                <td>

                  <!-- Tombol Verifikasi -->
                  <form action="{{ route('verifikasi-galery.verifikasi', $g->id) }}" 
                        method="POST" 
                        style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm" 
                            onclick="return confirm('Setujui galeri ini?')">
                      <i class="fa fa-check"></i>
                    </button>
                  </form>

                  <!-- Tombol Tolak -->
                  <form action="{{ route('verifikasi-galery.tolak', $g->id) }}" 
                        method="POST" 
                        style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tolak galeri ini?')">
                      <i class="fa fa-times"></i>
                    </button>
                  </form>

                </td>
              </tr>

              @empty
                <tr>
                  <td colspan="7" class="text-center text-muted">
                    Tidak ada galeri menunggu verifikasi.
                  </td>
                </tr>
              @endforelse

            </tbody>
          </table>

          <!-- Pagination -->
          <div class="text-center">
            {{ $galery->links() }}
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

@endsection
