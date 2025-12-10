@extends('layouts.admin')

@section('content')

<section class="content-header">
  <h1>
    Data Galeri
    <small>Edit data galeri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('galery.index') }}">Data Galeri</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Data Galeri</h3>
  </div>

  <form action="{{ route('galery.update', $galery->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="box-body">
      <div class="row">

        {{-- Judul --}}
        <div class="col-md-6">
          <div class="form-group">
            <label>Judul Galeri <span class="text-danger">*</span></label>
            <input type="text" name="judul" class="form-control"
              value="{{ old('judul', $galery->judul) }}" required>
          </div>
        </div>

        {{-- Tanggal --}}
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Galeri <span class="text-danger">*</span></label>
            <input type="date" name="tanggal" class="form-control"
              value="{{ old('tanggal', $galery->tanggal) }}" required>
          </div>
        </div>

        {{-- Gambar --}}
        <div class="col-md-6">
          <div class="form-group">
            <label>Gambar (boleh dikosongkan jika tidak diganti)</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">

            @if ($galery->gambar)
              <div style="margin-top: 10px;">
                <p>Gambar Saat Ini:</p>
                <img src="{{ asset($galery->gambar) }}" alt="Gambar" width="150" class="img-thumbnail">
              </div>
            @endif
          </div>
        </div>

        {{-- Status --}}
        <div class="col-md-6">
          <div class="form-group">
            <label>Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control" required>
              <option value="">Pilih status</option>
              <option value="aktif" {{ old('status', $galery->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="menunggu" {{ old('status', $galery->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
              <option value="ditolak" {{ old('status', $galery->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
              <option value="draft" {{ old('status', $galery->status) == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
          </div>
        </div>

        {{-- Deskripsi --}}
        <div class="col-md-12">
          <div class="form-group">
            <label>Deskripsi <span class="text-danger">*</span></label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $galery->deskripsi) }}</textarea>
          </div>
        </div>

      </div>
    </div>

    <div class="box-footer text-right">
      <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
      <a href="{{ route('galery.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
</section>

@endsection
