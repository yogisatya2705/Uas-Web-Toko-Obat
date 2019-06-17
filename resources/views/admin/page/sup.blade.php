@extends('template')

{{-- TITLE --}}
@section('title')
  Manajemen Supplier
@endsection
{{-- END TITLE --}}

{{-- MENU SIDEBAR --}}
@section('mainMenu')
<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Supplier</a></li>
<li class="breadcrumb-item active" aria-current="page">
  @if ($act == 'showinput')
    Input Supplier
  @endif

  @if ($act == 'showlist' || $act == 'showdelete')
    List Supplier
  @endif

  @if ($act == 'showedit')
    Edit Supplier
  @endif
</li>
@endsection
{{-- END MENU SIDEBAR --}}

{{-- MENU CONTENT --}}
@if ($act == 'showinput')
  @section('activeMenuInputSupplier')
    active
  @endsection
@endif
@if ($act == 'showlist' || $act == 'showdelete' || $act == 'showedit')
  @section('activeMenuListSupplier')
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
      <h5 class="card-header">Input Supplier</h5>
      <div class="card-body">
        <form action="{{ url('sup/prosesinput') }}" id="basicform" data-parsley-validate="" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="inputid">ID</label>
            <input id="inputid" type="text" name="id" data-parsley-trigger="change" required="" autocomplete="off"
              class="form-control" disabled value="{{ $id }}">
            <input id="inputid" type="hidden" name="id" data-parsley-trigger="change" required="" autocomplete="off"
              class="form-control" value="{{ $id }}">
          </div>
          <div class="form-group">
            <label for="inputnama">Nama</label>
            <input id="inputnama" type="text" name="nama" data-parsley-trigger="change" required=""
              placeholder="Input nama" autocomplete="off" class="form-control">
          </div>
          <div class="form-group">
            <label for="inputalamat">Alamat</label>
            <textarea required="" class="form-control" name="alamat"></textarea>
          </div>
          <div class="form-group">
            <label for="inputnotelp">No Telp</label>
            <input id="inputnotelp" type="text" name="notelp" data-parsley-trigger="change" required=""
              placeholder="Input no telp" autocomplete="off" class="form-control">
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
      <h5 class="card-header">Edit Supplier</h5>
      <div class="card-body">
        <form action="{{ url('sup/prosesedit') }}" id="basicform" data-parsley-validate="" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="inputid">ID</label>
            <input id="inputid" type="text" name="id" data-parsley-trigger="change" required="" autocomplete="off"
              class="form-control" disabled value="{{ $listdata->id }}">
            <input id="inputid" type="hidden" name="id" data-parsley-trigger="change" required="" autocomplete="off"
              class="form-control" value="{{ $listdata->id }}">
          </div>
          <div class="form-group">
            <label for="inputnama">Nama</label>
            <input id="inputnama" type="text" name="nama" data-parsley-trigger="change" required=""
              placeholder="Input nama" autocomplete="off" class="form-control" value="{{ $listdata->nama }}">
          </div>
          <div class="form-group">
            <label for="inputalamat">Alamat</label>
            <textarea required="" class="form-control" name="alamat" id="alamat"></textarea>
          
            <input type="hidden" id="alamatsrc" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" value="{{ $listdata->alamat }}">
          </div>
          <div class="form-group">
            <label for="inputnotelp">No Telp</label>
            <input id="inputnotelp" type="text" name="notelp" data-parsley-trigger="change" required=""
              placeholder="Input no telp" autocomplete="off" class="form-control" value="{{ $listdata->telp }}">
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-space btn-primary">Submit</button>
            </div>
          </div>
          
          <script>
            var x = document.getElementById("alamatsrc").value;
            document.addEventListener('DOMContentLoaded', function() {
              document.getElementById("alamat").value = x;
            }, false);
          </script>
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
        <a href="{{ url('sup/showlist') }}" class="btn btn-primary btn-xs">Cancel</a>
        <a href="{{ url('sup/prosesdelete', $val_del) }}" class="btn btn-danger btn-xs">Hapus</a>
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
      <h5 class="card-header">Basic Table</h5>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered first">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Supplier</th>
                <th>Alamat Supplier</th>
                <th>No Telp</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($listdata as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->alamat}}</td>
                  <td>{{$item->telp}}</td>
                  <td>
                    <a href="{{ url('sup/showedit', $item->id) }}" class="btn btn-primary btn-xs">Edit</a>
                    <a href="{{ url('sup/showdelete', $item->id) }}" class="btn btn-danger btn-xs">Hapus</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Nama Supplier</th>
                <th>Alamat Supplier</th>
                <th>No Telp</th>
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