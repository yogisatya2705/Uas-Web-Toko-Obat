@extends('template')

@section('title')
  Manajemen Toko Homepage
@endsection

@section('mainMenu')
<li class="breadcrumb-item active" aria-current="page">Homepage</li>
@endsection

@section('activeMenuHomepage')
  active
@endsection

@section('content')
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
  <div class="card">
      <h5 class="card-header">Jumlah Supplier</h5>
      <div class="card-body">
          <div class="metric-value d-inline-block">
              <h1 class="mb-1 text-primary">{{$jsup}}</h1>
          </div>
      </div>
  </div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
  <div class="card">
      <h5 class="card-header">Jumlah Barang</h5>
      <div class="card-body">
          <div class="metric-value d-inline-block">
              <h1 class="mb-1 text-primary">{{$jbarang}}</h1>
          </div>
      </div>
  </div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
  <div class="card">
      <h5 class="card-header">Jumlah Transaksi</h5>
      <div class="card-body">
          <div class="metric-value d-inline-block">
              <h1 class="mb-1 text-primary">{{$jpemb}} </h1>
          </div>
      </div>
  </div>
</div>
@endsection