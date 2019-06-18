@extends('member.template')

{{-- TITLE --}}
@section('title')
Dashboard Member
@endsection
{{-- END TITLE --}}

{{-- MENU SIDEBAR --}}
@section('mainMenu')
<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Member</a></li>
<li class="breadcrumb-item active" aria-current="page">
  @if ($act == 'showlist')
  Dashboard
  @endif
</li>
@endsection
{{-- END MENU SIDEBAR --}}

{{-- MENU CONTENT --}}
@if ($act == 'showlist')
@section('activeMenuHomepage')
active
@endsection
@endif
{{-- END MENU CONTENT --}}

@section('content')
@if ($act == 'showlist')
<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
  <div class="card border-3 border-top border-top-primary">
    <div class="card-body">
      <h5 class="text-muted">My Point</h5>
      <div class="metric-value d-inline-block">
        <h1 class="mb-1">{{Auth::user()->point}}</h1>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  <div class="card">
    <h5 class="card-header">List Obat Yang Pernah Dibeli</h5>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered first">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Jumlah Beli</th>
              <th>Total Harga</th>
              <th>Dosis</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($databeli as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->barang->nama}}</td>
              <td>{{$item->jmlh_beli}}</td>
              <td>{{$item->total_hrg}}</td>
              <td>{{$item->dosis}} x Sehari</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Jumlah Beli</th>
              <th>Total Harga</th>
              <th>Dosis</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endif
@endsection



{{-- @extends('layouts.app')

@section('content')
@if ($act == 'showlist')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  <div class="card">
    <h5 class="card-header">List Data Yang Pernah Dibeli</h5>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered first">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Jumlah Beli</th>
              <th>Total Harga</th>
              <th>Dosis</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($databeli as $item)
            <tr>
              <td>{{$item->id}}</td>
<td>{{$item->barang->nama}}</td>
<td>{{$item->jmlh_beli}}</td>
<td>{{$item->total_hrg}}</td>
<td>{{$item->dosis}}</td>
</tr>
@endforeach
</tbody>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Nama Barang</th>
    <th>Jumlah Beli</th>
    <th>Total Harga</th>
    <th>Dosis</th>
  </tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>
@endif
@endsection --}}