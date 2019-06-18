@extends('template')

{{-- TITLE --}}
@section('title')
Manajemen Member
@endsection
{{-- END TITLE --}}

{{-- MENU SIDEBAR --}}
@section('mainMenu')
<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Member</a></li>
<li class="breadcrumb-item active" aria-current="page">
  @if ($act == 'showinput')
  Input Member
  @endif

  @if ($act == 'showlist' || $act == 'showdelete')
  List Member
  @endif

  @if ($act == 'showedit')
  Edit Member
  @endif
</li>
@endsection
{{-- END MENU SIDEBAR --}}

{{-- MENU CONTENT --}}
@if ($act == 'showinput')
@section('activeMenuInputMember')
active
@endsection
@endif
@if ($act == 'showlist' || $act == 'showdelete' || $act == 'showedit')
@section('activeMenuListMember')
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
@if (isset($msg))
<?php  echo viewMessage($msg); ?>
@endif

@if ($act == 'showinput')
<div style="
height: 100%;
display: -ms-flexbox;
display: flex;
-ms-flex-align: center;
align-items: center;
padding-bottom: 40px;
" class="col-12">
  <!-- ============================================================== -->
  <!-- signup form  -->
  <!-- ============================================================== -->
  <form class="splash-container" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="card">
      <div class="card-header">
        <h3 class="mb-1">Registrations Member</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>


        <div class="form-group">
          <label for="inputnama">Jenis Kelamin</label><br>
          <label class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="jk" id="jk_L" class="custom-control-input" value="L"><span
              class="custom-control-label">Laki - Laki</span>
          </label>
          <label class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="jk_P" checked="" name="jk" class="custom-control-input" value="P"><span
              class="custom-control-label">Perempuan</span>
          </label>
        </div>
        <div class="form-group">
          <label for="tgllahir">Tanggal Lahir</label>
          <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
            <input type="text" name="tgllahir" class="form-control datetimepicker-input"
              data-target="#datetimepicker4" />
            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea class="form-control" id="alamat" rows="3" required name="alamat" placeholder="Alamat"></textarea>
        </div>
        <div class="form-group">
          <input id="inputnotelp" type="text" name="nohp" data-parsley-trigger="change" required="" placeholder="No Hp"
            autocomplete="off" class="form-control">
        </div>

        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password" placeholder="Password">
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password" placeholder="Comfirm Password">
        </div>
        <div class="form-group pt-2">
          <button class="btn btn-block btn-primary" type="submit">Register</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endif

@if ($act == 'showedit')
<div style="
height: 100%;
display: -ms-flexbox;
display: flex;
-ms-flex-align: center;
align-items: center;
padding-bottom: 40px;
" class="col-12">
  <!-- ============================================================== -->
  <!-- signup form  -->
  <!-- ============================================================== -->
  <form class="splash-container" method="POST" action="{{ url('memb/prosesedit') }}">
    @csrf
    <div class="card">
      <div class="card-header">
        <h3 class="mb-1">Edit Member</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <input id="name" type="hidden" class="form-control" name="id" value="{{$listdata->id}}" required
            autocomplete="name" autofocus placeholder="Nama">
          <input id="name" disabled type="text" class="form-control" name="id" value="{{$listdata->id}}" required
            autocomplete="name" autofocus placeholder="Nama">
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ $listdata->name }}" required autocomplete="name" autofocus placeholder="Nama">
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputnama">Jenis Kelamin</label><br>
          @if ($listdata->jk == 'L')
          <label class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="jk" checked="" id="jk_L" class="custom-control-input" value="L"><span
              class="custom-control-label">Laki - Laki</span>
          </label>
          <label class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="jk_P" name="jk" class="custom-control-input" value="P"><span
              class="custom-control-label">Perempuan</span>
          </label>
          @else
          <label class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="jk" id="jk_L" class="custom-control-input" value="L"><span
              class="custom-control-label">Laki - Laki</span>
          </label>
          <label class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="jk_P" checked="" name="jk" class="custom-control-input" value="P"><span
              class="custom-control-label">Perempuan</span>
          </label>
          @endif
        </div>
        <div class="form-group">
          <label for="tgllahir">Tanggal Lahir</label>
          <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
            <input type="text" name="tgllahir" class="form-control datetimepicker-input"
              data-target="#datetimepicker4" value="{{$listdata->tgllahir}}" />
            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea class="form-control" id="alamat" rows="3" required name="alamat" placeholder="Alamat">{{$listdata->alamat}}</textarea>
        </div>
        <div class="form-group">
          <input id="inputnotelp" type="text" name="nohp" data-parsley-trigger="change" required="" placeholder="No Hp"
            autocomplete="off" class="form-control" value="{{$listdata->nohp}}">
        </div>

        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ $listdata->email }}" required autocomplete="email" placeholder="E-mail">
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <input id="password" type="text" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password" placeholder="Password" >
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group pt-2">
          <button class="btn btn-block btn-primary" type="submit">Register</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endif

@if ($act == 'showlist' || $act == 'showdelete')
@if (isset($val_del))
<div class="alert alert-warning alert-dismissible fade show col-12" role="alert">
  Anda yakin menghapus data {{$val_del}} ?

  <div class="float-right">
    <a href="{{ url('memb/showlist') }}" class="btn btn-primary btn-xs">Cancel</a>
    <a href="{{ url('memb/prosesdelete', $val_del) }}" class="btn btn-danger btn-xs">Hapus</a>
  </div>

  <a href="#" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </a>
</div>
@endif

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  <div class="card">
    <h5 class="card-header">List Data Member</h5>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered first">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>E-mail</th>
              <th>JK</th>
              <th>Tgl Lahir</th>
              <th>Alamat</th>
              <th>No HP</th>
              <th>Point</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($listdata as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->email}}</td>
              <td>{{$item->jk}}</td>
              <td>{{$item->tgllahir}}</td>
              <td>{{$item->alamat}}</td>
              <td>{{$item->nohp}}</td>
              <td>{{$item->point}} Point</td>
              <td>
                <a href="{{ url('memb/showedit', $item->id) }}" class="btn btn-primary btn-xs">Edit</a>
                <a href="{{ url('memb/showdelete', $item->id) }}" class="btn btn-danger btn-xs">Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>E-mail</th>
              <th>JK</th>
              <th>Tgl Lahir</th>
              <th>Alamat</th>
              <th>No HP</th>
              <th>Point</th>
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