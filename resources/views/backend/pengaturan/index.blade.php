@extends('layouts.admin')
@section('content')

<section class="content-header">
  <h1>
    Pengaturan Akun
    <small>Ubah informasi akun Anda</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pengaturan Akun</li>
  </ol>
</section>

<section class="content">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Informasi Akun</h3>
    </div>

    <form action="{{ route('pengaturan-akun.update') }}" method="POST">
      @csrf

      <div class="box-body">

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul style="margin:0; padding-left:18px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}"
                     class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Email <span class="text-danger">*</span></label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}"
                     class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Password Baru (opsional)</label>
              <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
            </div>
          </div>

        </div>
      </div>

      <div class="box-footer text-right">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>

    </form>
  </div>

</section>

@endsection
