@extends('layouts.admin')
@section('content')

<section class="content-header">
  <h1>
    Data Galeri
    <small>Tambah galeri baru</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('galery.index') }}">Data galeri</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Galeri</h3>
      <div class="box-tools">
        <a href="{{ route('galery.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="box-body">
      <form action="{{ route('galery.store') }}" method="POST" enctype="multipart/form-data" id="form">
        @csrf

        <div class="row">
          <div class="form-group col-md-6">
            <label>Judul Galeri <span class="text-danger">*</span></label>
            <input type="text" name="judul" class="form-control" placeholder="Masukan judul galeri" required>
          </div>

          <div class="form-group col-md-6">
            <label>Tanggal Galeri <span class="text-danger">*</span></label>
            <input type="date" name="tanggal" class="form-control" required>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Gambar <span class="text-danger">*</span></label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
          </div>

          <div class="form-group col-md-6">
            <label>Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control" required>
              <option value="">Pilih status</option>
              <option value="aktif">Aktif</option>
              <option value="menunggu">Menunggu</option>
              <option value="ditolak">Ditolak</option>
              <option value="draft">Draft</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label>Deskripsi <span class="text-danger">*</span></label>
            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukan deskripsi galeri" required></textarea>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Tambah Data
          </button>
          <a href="{{ route('galery.index') }}" class="btn btn-secondary">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
