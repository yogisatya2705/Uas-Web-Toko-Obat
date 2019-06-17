@extends('template')

{{-- TITLE --}}
@section('title')
Manajemen Pembelian
@endsection
{{-- END TITLE --}}

{{-- MENU SIDEBAR --}}
@section('mainMenu')
<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pembelian</a></li>
<li class="breadcrumb-item active" aria-current="page">
  @if ($act == 'showinput' || $act == 'showinputbeli')
  Input Pembelian
  @endif

  @if ($act == 'showlist' || $act == 'showdelete')
  List Pembelian
  @endif

  @if ($act == 'showedit')
  Edit Pembelian
  @endif
</li>
@endsection
{{-- END MENU SIDEBAR --}}

{{-- MENU CONTENT --}}
@if ($act == 'showinput' || $act == 'showinputbeli')
@section('activeMenuInputPembelian')
active
@endsection
@endif
@if ($act == 'showlist' || $act == 'showdelete' || $act == 'showedit')
@section('activeMenuListPembelian')
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
    <div class="card-body">
      <div class="form-group col-12">
        <input id="searchcol" class="form-control float-right" type="text" placeholder="Search.."
          onkeyup="searchFunc()">
      </div>
    </div>
  </div>
</div>

<div class="col-12">
  <div id="searchcont" class="row">
    @foreach ($listdata as $item)
    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 searchitem">
      <div class="product-thumbnail">
        <div class="product-img-head">
          <div class="product-img">
            <img src="{{ asset('assets/images/eco-product-img-4.png')}}" alt="" class="img-fluid"></div>
        </div>
        <div class="product-content">
          <div class="product-content-head">
            <h3 class="product-title">{{ $item->nama }}
              @if ($item->stok <= 0) <span class="text-danger">
                STOK HABIS!!
                </span>
                @endif
            </h3>
            <div class="product-rating d-inline-block">
              <i class="fa fa-fw fa-star"></i>
              <i class="fa fa-fw fa-star"></i>
              <i class="fa fa-fw fa-star"></i>
              <i class="fa fa-fw fa-star"></i>
              <i class="fa fa-fw fa-star"></i>
            </div>
            <div class="product-price">Rp. {{ $item->harga }} / {{$item->point}} Point</div>
          </div>
          <div class="product-btn">
            <a href="{{ url('pemb/showinput/beli', $item->id) }}" class="btn btn-primary
                    @if ($item->stok <= 0)
                      disabled
                    @endif  
                    ">Beli Barang</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<script>
  function searchFunc() {
        var input, filter, ul, li, a, i, txtValue, x;
        input = document.getElementById("searchcol");
        filter = input.value.toUpperCase();
        ul = document.getElementById("searchcont");
        x = ul.getElementsByClassName("searchitem");
        li = ul.getElementsByClassName("product-content-head");
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByClassName("product-title")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            x[i].style.display = "";
          } else {
            x[i].style.display = "none";
          }
        }
      }
</script>
@endif

@if ($act == 'showinputbeli')
@if (isset($msg))
<?php  echo viewMessage($msg); ?>
@endif

<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pr-xl-0 pr-lg-0 pr-md-0  m-b-30">
      <div class="product-slider">
        <div id="productslider-1" class="product-carousel carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block" src="{{ asset('assets/images/eco-slider-img-1.png')}}" alt="First slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <form action="{{ url('pemb/prosesinput') }}" id="prosesinput" data-parsley-validate="" method="POST"
      class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-xl-0 pl-lg-0 pl-md-0 border-left m-b-30">
      {{ csrf_field() }}
      <div class="product-details">
        <div class="border-bottom pb-3 mb-3">
          <h2 class="mb-3">{{ $databar->nama }}
            @if ($databar->stok <= 0) <span class="text-danger">
              STOK HABIS!!
              </span>
              @endif
          </h2>
          <div class="product-rating d-inline-block float-right">
            <i class="fa fa-fw fa-star"></i>
            <i class="fa fa-fw fa-star"></i>
            <i class="fa fa-fw fa-star"></i>
            <i class="fa fa-fw fa-star"></i>
            <i class="fa fa-fw fa-star"></i>
          </div>
          <h3 class="mb-0 text-primary">Rp. {{ $databar->harga }} / {{ $databar->point }} Point</h3>
          <input type="hidden" name="harga" id="harga" value="{{ $databar->harga }}">
          <input type="hidden" name="point" id="point" value="{{ $databar->point }}">
        </div>
        <div class="product-colors border-bottom">
          <h4>Nama Pembeli</h4>
          {{-- <input type="text" name="nama" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control"> --}}

          <select class="form-control js-example-basic-single" name="nama" required>
            <option value=""></option>
            @foreach ($datauser as $item)
            <option value="{{ $item->id }}">{{$item->name}} - {{$item->point}} Point</option>
            @endforeach
          </select>

          {{-- SELECT SEARCH BOX --}}
          <script src="{{ asset('assets/select2/select2.min.js')}}"></script>
          <script>
            $(document).ready(function() {
                      $('.js-example-basic-single').select2();
                  });
          </script>
        </div>
        <div class="product-colors border-bottom">
          <h4>Point</h4>
          <input type="number" name="point" data-parsley-trigger="change" autocomplete="off" class="form-control">
        </div>
        <div class="product-colors border-bottom">
          <h4>Dosis</h4>
          <input type="number" name="dosis" data-parsley-trigger="change" autocomplete="off" class="form-control" style="width:50%; display:inline">&nbsp;x sehari
        </div>
        <div class="product-size border-bottom">
          <h4>Quantity</h4>
          <div class="btn-group" role="group" aria-label="First group">
            <div class="quantity">
              <input id="jumlahbar" name="jumlahbar" type="number" min="1" max="{{ $databar->stok }}" step="1"
                value="1">
            </div>
          </div>
        </div>
        <div class="product-description">
          <h4 class="mb-1">Descriptions</h4>
          <p>
            {{ $databar->id }} - {{ $databar->nama }}
            <input type="hidden" name="idbar" value="{{ $databar->id }}">
            <hr>
            <h5>
              Total Harga : Rp.
              <span id="totaldis">
              </span>
              <input type="hidden" name="total" id="total" value="{{ $databar->harga }}">
            </h5>
            {{-- <hr> --}}
          </p>
          <button type="submit" class="btn btn-primary btn-block btn-lg" @if ($databar->stok <= 0) disabled @endif>
              Beli Dengan Uang</button>
        </div>
        <div class="product-description">
          <p>
            <h5>
              Total Point Ditukar :
              <span id="totalpoint">
              </span>
              <input type="hidden" name="totalpoint" id="totalpointval" value="{{ $databar->point }}">
            </h5>
            {{-- <hr> --}}
            <div id="checkispoint" style="display:none">
              <label class="custom-control custom-radio custom-control-inline">
                <input type="radio" name="isPoint" id="isPoint1" class="custom-control-input" value="1"><span
                  class="custom-control-label">ON</span>
              </label>
              <label class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="isPoint0" checked="" name="isPoint" class="custom-control-input" value="0"><span
                  class="custom-control-label">OFF</span>
              </label>
            </div>
          </p>
          <button type="button" onclick="handle_form_submission()" class="btn btn-primary btn-block btn-lg" @if($databar->stok <= 0) disabled @endif>
              Beli Dengan Point</button>
        </div>
      </div>
    </form>
    <script>
      function handle_form_submission()
      {
        document.getElementById("isPoint1").checked = true;
        document.getElementById('prosesinput').submit();
      }
    </script>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60">
      <div class="simple-card">
        <ul class="nav nav-tabs" id="myTab5" role="tablist">
          <li class="nav-item">
            <a class="nav-link active border-left-0" id="product-tab-1" data-toggle="tab" href="#tab-1" role="tab"
              aria-controls="product-tab-1" aria-selected="true">Deskripsi Supplier</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent5">
          <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="product-tab-1">
            <p>Nama Supplier : {{ $datasup->nama }}</p>
            <p>Alamat Supplier : {{ $datasup->alamat }}</p>
            <p>No Telp Supplier : {{ $datasup->telp }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- SCRIPT + - BARANG --}}
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
<script>
  jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
      jQuery('.quantity').each(function() {
          var spinner = jQuery(this),
              input = spinner.find('input[type="number"]'),
              btnUp = spinner.find('.quantity-up'),
              btnDown = spinner.find('.quantity-down'),
              min = input.attr('min'),
              max = input.attr('max');

          btnUp.click(function() {
              var oldValue = parseFloat(input.val());
              if (oldValue >= max) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue + 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
              
              // MENGHITUNG TOTAL
              var harga, jumlah, total;

              harga = document.getElementById("harga").value;
              jumlah = document.getElementById("jumlahbar").value;

              total = harga * jumlah;

              document.getElementById("totaldis").textContent = total;
              document.getElementById("total").value = total;
              // END MENGHITUNG TOTAL
              
              // MENGHITUNG TOTAL POINT
              var point, totalpoint;

              point = document.getElementById("point").value;

              totalpoint = point * jumlah;

              document.getElementById("totalpoint").textContent = totalpoint;
              document.getElementById("totalpointval").value = totalpoint;
              // END MENGHITUNG TOTAL POINT
          });

          btnDown.click(function() {
              var oldValue = parseFloat(input.val());
              if (oldValue <= min) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue - 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
              
              // MENGHITUNG TOTAL
              var harga, jumlah, total;

              harga = document.getElementById("harga").value;
              jumlah = document.getElementById("jumlahbar").value;

              total = harga * jumlah;

              document.getElementById("totaldis").textContent = total;
              document.getElementById("total").value = total;
              // END MENGHITUNG TOTAL
              
              // MENGHITUNG TOTAL POINT
              var point, totalpoint;

              point = document.getElementById("point").value;

              totalpoint = point * jumlah;

              document.getElementById("totalpoint").textContent = totalpoint;
              document.getElementById("totalpointval").value = totalpoint;
              // END MENGHITUNG TOTAL POINT
          });

          // MENGHITUNG TOTAL
          var harga, jumlah, total;

          harga = document.getElementById("harga").value;
          jumlah = document.getElementById("jumlahbar").value;

          total = harga * jumlah;

          document.getElementById("totaldis").textContent = total;
          document.getElementById("total").value = total;
          // END MENGHITUNG TOTAL
              
          // MENGHITUNG TOTAL POINT
          var point, totalpoint;

          point = document.getElementById("point").value;

          totalpoint = point * jumlah;

          document.getElementById("totalpoint").textContent = totalpoint;
          document.getElementById("totalpointval").value = totalpoint;
          // END MENGHITUNG TOTAL POINT
      });
</script>
{{-- END SCRIPT + - BARANG --}}
@endif

@if ($act == 'showedit')
@if (isset($msg))
<?php  echo viewMessage($msg); ?>
@endif

<div class="col-12">
  <div class="card">
    <h5 class="card-header">Edit Pembelian</h5>
    <div class="card-body">
      <form action="{{ url('pemb/prosesedit') }}" id="basicform" data-parsley-validate="" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="inputid">ID</label>
          <input id="inputid" type="text" name="id" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" disabled value="{{ $listdata->id }}">
          <input id="inputid" type="hidden" name="id" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" value="{{ $listdata->id }}">
          <input id="inputid" type="hidden" name="idbar" data-parsley-trigger="change" required="" autocomplete="off"
            class="form-control" value="{{ $bar->id }}">
        </div>
        <div class="form-group">
          <label for="inputnama">Nama Barang</label>
          <input id="inputnama" type="text" name="nama" data-parsley-trigger="change" required=""
            placeholder="Input nama barang" autocomplete="off" class="form-control"
            value="{{ $bar->id }} - {{ $bar->nama }}" disabled>
        </div>
        <div class="form-group">
          <label for="inputnamapemb">Nama Pembeli</label>
          <input id="inputnamapemb" type="text" name="namapemb" data-parsley-trigger="change" required=""
            placeholder="Input nama barang" autocomplete="off" class="form-control" value="{{ $listdata->nama_pemb }}">
        </div>

        <div class="form-group">
          <label for="jumlahbar" class="col-form-label">Jumlah Beli</label>
          <br>
          <div class="btn-group" role="group" aria-label="First group">
            <div class="quantity">
              @php
              $bar->stok = $bar->stok + $listdata->jmlh_beli;
              @endphp
              <input id="jumlahbar" class="form-control" name="jumlahbar" type="number" min="1" max="{{ $bar->stok }}"
                step="1" value="{{ $listdata->jmlh_beli }}">
              <input type="hidden" name="jumlahbarsebelum" value="{{ $listdata->jmlh_beli }}">
              <div class="float-right">
                <div class="quantity-button quantity-up">+</div>
                <div class="quantity-button quantity-down">-</div>
              </div>
            </div>
          </div>
        </div>

        <hr>
        <div class="form-group">
          <label for="inputnotelp">Total Harga</label>
          <h5><span id="totaldis"></span></h5>
          <input type="hidden" name="total" id="total" value="{{ $listdata->total_hrg }}">
          <input type="hidden" name="tgl" id="tgl" value="{{ $listdata->tanggal }}">
          <input type="hidden" name="harga" id="harga" value="{{ $bar->harga }}">
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

{{-- SCRIPT + - BARANG --}}
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
<script>
  jQuery('.quantity').each(function() {
          var spinner = jQuery(this),
              input = spinner.find('input[type="number"]'),
              btnUp = spinner.find('.quantity-up'),
              btnDown = spinner.find('.quantity-down'),
              min = input.attr('min'),
              max = input.attr('max');

          btnUp.click(function() {
              var oldValue = parseFloat(input.val());
              if (oldValue >= max) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue + 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
              
              // MENGHITUNG TOTAL
              var harga, jumlah, total;

              harga = document.getElementById("harga").value;
              jumlah = document.getElementById("jumlahbar").value;

              total = harga * jumlah;

              document.getElementById("totaldis").textContent = total;
              document.getElementById("total").value = total;
              // END MENGHITUNG TOTAL
          });

          btnDown.click(function() {
              var oldValue = parseFloat(input.val());
              if (oldValue <= min) {
                  var newVal = oldValue;
              } else {
                  var newVal = oldValue - 1;
              }
              spinner.find("input").val(newVal);
              spinner.find("input").trigger("change");
              
              // MENGHITUNG TOTAL
              var harga, jumlah, total;

              harga = document.getElementById("harga").value;
              jumlah = document.getElementById("jumlahbar").value;

              total = harga * jumlah;

              document.getElementById("totaldis").textContent = total;
              document.getElementById("total").value = total;
              // END MENGHITUNG TOTAL
          });

          // MENGHITUNG TOTAL
          var harga, jumlah, total;

          harga = document.getElementById("harga").value;
          jumlah = document.getElementById("jumlahbar").value;

          total = harga * jumlah;

          document.getElementById("totaldis").textContent = total;
          document.getElementById("total").value = total;
          // END MENGHITUNG TOTAL
      });
</script>
{{-- END SCRIPT + - BARANG --}}
@endif

@if ($act == 'showlist' || $act == 'showdelete')
@if (isset($val_del))
<div class="alert alert-warning alert-dismissible fade show col-12" role="alert">
  Anda yakin menghapus data {{$val_del}} ?

  <div class="float-right">
    <a href="{{ url('pemb/showlist') }}" class="btn btn-primary btn-xs">Cancel</a>
    <a href="{{ url('pemb/prosesdelete', $val_del) }}" class="btn btn-danger btn-xs">Hapus</a>
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
    <h5 class="card-header">List Data Pembelian</h5>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered first">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tanggal</th>
              <th>Barang</th>
              <th>Jumlah Beli</th>
              <th>Total Harga</th>
              <th>Nama Pembeli</th>
              <th>Dosis</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($listdata as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->tanggal}}</td>
              <td>{{$item->id_bar}}</td>
              <td>{{$item->jmlh_beli}}</td>
              <td>Rp. {{$item->total_hrg}}</td>
              <td>{{$item->users->name}}</td>
              <td>{{$item->dosis}}</td>
              <td>
                {{-- <a href="{{ url('pemb/showedit', $item->id) }}" class="btn btn-primary btn-xs">Edit</a> --}}
                <a href="{{ url('pemb/showdelete', $item->id) }}" class="btn btn-danger btn-xs">Hapus</a>
                <a href="{{ url('pemb/showdetailbar', $item->id_bar) }}" class="btn btn-brand btn-xs">
                  Detail Barang
                </a>

                @if (isset($detail_bar))
                <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$detail_bar->id}} - {{$detail_bar->nama}}</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </a>
                      </div>
                      <div class="modal-body">
                        <p>Nama : {{$detail_bar->nama}}</p>
                        <p>Stok : {{$detail_bar->stok}}</p>
                        <p>Harga : {{$detail_bar->harga}}</p>
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
              <th>Tanggal</th>
              <th>Barang</th>
              <th>Jumlah Beli</th>
              <th>Total Harga</th>
              <th>Nama Pembeli</th>
              <th>Dosis</th>
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