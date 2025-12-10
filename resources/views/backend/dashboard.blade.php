@extends('layouts.admin')

@section('content')

<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel {{ Auth::user()->role }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">

  <div class="row">

    <div class="col-lg-6 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $total_galeri }}</h3>
          <p>Total Galeri</p>
        </div>
        <div class="icon">
          <i class="ion ion-images"></i>
        </div>
        <a href="{{ route('galery.index') }}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $galeri_menunggu }}</h3>
          <p>Galeri Belum Terverifikasi</p>
        </div>
        <div class="icon">
          <i class="ion ion-alert-circled"></i>
        </div>
        <a href="{{ route('verifikasi-galery.index') }}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $total_akun }}</h3>
          <p>Akun Tersedia</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

  </div>

</section>

@endsection
