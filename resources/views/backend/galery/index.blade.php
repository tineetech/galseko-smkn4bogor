@extends('layouts.admin')
@section('content')

<!-- Content Header -->
<section class="content-header">
  <h1>
    Galery
    <small>Kelola galery</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kelola galery</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Galery Tersedia</h3>
          <div class="box-tools">
            <a href="{{ route('galery.create') }}" class="btn btn-primary btn-sm">
              <i class="fa fa-plus"></i> Tambah Galery
            </a>
          </div>
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
                           alt="Gambar" 
                           style="width:100px; height:70px; object-fit:cover;">
                    @else
                      <span class="text-muted">Tidak ada gambar</span>
                    @endif
                  </td>

                  <td>{{ $g->judul }}</td>

                  <td>{{ \Carbon\Carbon::parse($g->tanggal)->format('d/m/Y') }}</td>

                  <td>{{ Str::limit($g->deskripsi, 60) }}</td>

                  <td>
                    @if ($g->status == 'aktif')
                      <span class="label label-success">Aktif</span>
                    @elseif ($g->status == 'menunggu')
                      <span class="label label-warning">Menunggu</span>
                    @elseif ($g->status == 'ditolak')
                      <span class="label label-danger">Ditolak</span>
                    @else
                      <span class="label label-default">Draft</span>
                    @endif
                  </td>

                  <td>
                    <a href="{{ route('galery.edit', $g->id) }}" 
                       class="btn btn-warning btn-sm">
                      <i class="fa fa-edit"></i> Edit
                    </a>

                    <form action="{{ route('galery.destroy', $g->id) }}" 
                          method="POST" 
                          style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" 
                              onclick="return confirm('Yakin ingin menghapus?')" 
                              class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Hapus
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center text-muted">
                    Belum ada data galery.
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
