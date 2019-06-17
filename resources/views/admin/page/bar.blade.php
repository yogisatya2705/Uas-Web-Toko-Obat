@extends('template')

{{-- TITLE --}}
@section('title')
Manajemen Barang
@endsection
{{-- END TITLE --}}

{{-- MENU SIDEBAR --}}
@section('mainMenu')
<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Barang</a></li>
<li class="breadcrumb-item active" aria-current="page">
  @if ($act == 'showinput')
  Input Barang
  @endif

  @if ($act == 'showlist' || $act == 'showdelete')
  List Barang
  @endif

  @if ($act == 'showedit')
  Edit Barang
  @endif
</li>
@endsection
{{-- END MENU SIDEBAR --}}

{{-- MENU CONTENT --}}
@if ($act == 'showinput')
@section('activeMenuInputBarang')
active
@endsection
@endif
@if ($act == 'showlist' || $act == 'showdelete' || $act == 'showedit')
@section('activeMenuListBarang')
active
@endsection
@endif
{{-- END MENU CONTENT --}}

@php
function viewMessage($msg){
$pesan = "";
$view = "";

if($msg==1)
{
$pesan = "Proses tambah data berhasil dilakukan!";
$view = "
<div class=\"alert alert-success alert-dismissible fade show col-12\" role=\"alert\">
  ".$pesan."
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">×</span>
  </a>
</div>
";
}elseif($msg==2){
$pesan = "Error! Proses tambah data gagal dilakukan!";
$view = "
<div class=\"alert alert-danger alert-dismissible fade show col-12\" role=\"alert\">
  ".$pesan."
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">×</span>
  </a>
</div>
";
}elseif($msg==3){
$pesan = "Proses edit data berhasil dilakukan!";
$view = "
<div class=\"alert alert-success alert-dismissible fade show col-12\" role=\"alert\">
  ".$pesan."
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">×</span>
  </a>
</div>
";
}elseif($msg==4){
$pesan = "Error! Proses edit data gagal dilakukan!";
$view = "
<div class=\"alert alert-danger alert-dismissible fade show col-12\" role=\"alert\">
  ".$pesan."
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">×</span>
  </a>
</div>
";
}elseif($msg==5){
$pesan = "Proses hapus data berhasil dilakukan!";
$view = "
<div class=\"alert alert-success alert-dismissible fade show col-12\" role=\"alert\">
  ".$pesan."
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">×</span>
  </a>
</div>
";
}elseif($msg==6){
$pesan = "Error! Proses hapus data gagal dilakukan!";
$view = "
<div class=\"alert alert-danger alert-dismissible fade show col-12\" role=\"alert\">
  ".$pesan."
  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">×</span>
  </a>
</div>
";
}

return $view;
}
@endphp

{{-- CONTENT --}}
@section('content')
@if ($act == 'showinput')
@if (isset($msg))
<?php  echo viewMessage($msg); ?>
@endif
<div class="col-12">
  <div class="card">
    <h5 class="card-header">Input Barang</h5>
    <div class="card-body">
      <form action="{{ url('bar/prosesinput') }}" id="basicform" data-parsley-validate="" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="inputid">ID</label>
          <input id="inputid" type="text" name="id" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" disabled value="{{ $id }}">
          <input id="inputid" type="hidden" name="id" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" value="{{ $id }}">
        </div>
        <div class="form-group">
          <label for="inputnama">Nama Obat</label>
          <input id="inputnama" type="text" name="nama" data-parsley-trigger="change" required=""
            placeholder="Input nama barang" autocomplete="off" class="form-control">
        </div>
        <div class="form-group">
          <label for="inputstok" class="col-form-label">Stok Obat</label>
          <input id="inputstok" type="number" name="stok" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control">
        </div>
        <div class="form-group">
          <label for="inputnotelp">Harga</label>
          <input id="inputnotelp" type="text" name="harga" data-parsley-trigger="change" required=""
            placeholder="Input harga barang" autocomplete="off" class="form-control">
        </div>
        <div class="form-group">
          <label for="inputnotelp">Setara dengan point</label>
          <input id="inputnotelp" type="text" name="point" data-parsley-trigger="change" required=""
            placeholder="Input point barang" autocomplete="off" class="form-control">
        </div>
        <div class="form-group">
          <label for="input-select">Supplier</label>
          <select class="form-control" id="input-select" name="id_sup">
            @foreach ($listsup as $item)
            <option value="{{ $item->id }}">{{ $item->id }} - {{$item->nama}}</option>
            @endforeach
          </select>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-space btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endif

@if ($act == 'showedit')
@if (isset($msg))
<?php  echo viewMessage($msg); ?>
@endif
<div class="col-12">
  <div class="card">
    <h5 class="card-header">Edit Barang</h5>
    <div class="card-body">
      <form action="{{ url('bar/prosesedit') }}" id="basicform" data-parsley-validate="" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="inputid">ID</label>
          <input id="inputid" type="text" name="id" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" disabled value="{{ $listdata->id }}">
          <input id="inputid" type="hidden" name="id" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" value="{{ $listdata->id }}">
        </div>
        <div class="form-group">
          <label for="inputnama">Nama Barang</label>
          <input id="inputnama" type="text" name="nama" data-parsley-trigger="change" required=""
            placeholder="Input nama barang" autocomplete="off" class="form-control" value="{{ $listdata->nama }}">
        </div>
        <div class="form-group">
          <label for="inputstok" class="col-form-label">Stok Barang</label>
          <input id="inputstok" type="number" name="stok" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" value="{{ $listdata->stok }}">
        </div>
        <div class="form-group">
          <label for="inputnotelp">Harga</label>
          <input id="inputnotelp" type="text" name="harga" data-parsley-trigger="change" required=""
            placeholder="Input harga barang" autocomplete="off" class="form-control" value="{{ $listdata->harga }}">
        </div>
        <div class="form-group">
          <label for="inputnotelp">Setara dengan point</label>
          <input id="inputnotelp" type="text" name="point" data-parsley-trigger="change" required=""
            placeholder="Input point barang" autocomplete="off" class="form-control" value="{{ $listdata->point }}">
          </div>
          <div class=" form-group">
          <label for="input-select">Supplier</label>
          <select class="form-control" id="input-select" name="id_sup">
            @foreach ($listsup as $item)
            @if ($item->id == $listdata->id_sup)
            <option value="{{ $item->id }}">{{ $item->id }} - {{$item->nama}}</option>
            @endif
            @endforeach

            @foreach ($listsup as $item)
            @if ($item->id != $listdata->id_sup)
            <option value="{{ $item->id }}">{{ $item->id }} - {{$item->nama}}</option>
            @endif
            @endforeach
          </select>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-space btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endif

@if ($act == 'showlist' || $act == 'showdelete')
@if (isset($val_del))
<div class="alert alert-warning alert-dismissible fade show col-12" role="alert">
  Anda yakin menghapus data {{$val_del}} ?

  <div class="float-right">
    <a href="{{ url('bar/showlist') }}" class="btn btn-primary btn-xs">Cancel</a>
    <a href="{{ url('bar/prosesdelete', $val_del) }}" class="btn btn-danger btn-xs">Hapus</a>
  </div>

  <a href="#" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </a>
</div>
@endif

@if (isset($msg))
<?php  echo viewMessage($msg); ?>
@endif

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  <div class="card">
    <h5 class="card-header">List Data Barang</h5>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered first">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Stok</th>
              <th>Harga - Point</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($listdata as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->nama}}</td>
              <td>{{$item->stok}}</td>
              <td>{{$item->harga}} - {{$item->point}} Point</td>
              <td>
                <a href="{{ url('bar/showedit', $item->id) }}" class="btn btn-primary btn-xs">Edit</a>
                <a href="{{ url('bar/showdelete', $item->id) }}" class="btn btn-danger btn-xs">Hapus</a>
                <a href="{{ url('bar/showdetailsup', $item->id_sup) }}" class="btn btn-brand btn-xs">
                  Detail Supplier
                </a>

                @if (isset($detail_sup))
                <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$detail_sup->id}} - {{$detail_sup->nama}}</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </a>
                      </div>
                      <div class="modal-body">
                        <p>Nama : {{$detail_sup->nama}}</p>
                        <p>Alamat : {{$detail_sup->alamat}}</p>
                        <p>No Telp : {{$detail_sup->telp}}</p>
                      </div>
                      <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                      </div>
                    </div>
                  </div>
                </div>

                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                          $('#detailmodal').modal('show');
                        }, false);
                </script>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Stok</th>
              <th>Harga</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
{{-- END CONTENT --}}