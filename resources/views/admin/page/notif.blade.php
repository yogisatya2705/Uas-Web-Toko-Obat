@php
use App\Http\Controllers\AdminController;
$dataultah = AdminController::NotifUltah();
$dataobathabos = AdminController::NotifObat();
// dd($dataultah);
@endphp
@foreach ($dataultah as $item)
<a href="#" class="list-group-item list-group-item-action active">
  <div class="notification-info">
    <div class="notification-list-user-img"><img src="{{asset('assets/img/cake.png')}}" alt=""
        class="user-avatar-md rounded-circle"></div>
    <div class="notification-list-user-block"><span class="notification-list-user-name">{{$item->name}}</span>Berulang tahun hari ini!
      <div class="notification-date">{{$item->tgllahir}}</div>
    </div>
  </div>
</a>
@endforeach

@foreach ($dataobathabos as $item)
<a href="#" class="list-group-item list-group-item-action active">
  <div class="notification-info">
    <div class="notification-list-user-img"><img src="{{asset('assets/img/pills.png')}}" alt=""
        class="user-avatar-md rounded-circle"></div>
    <div class="notification-list-user-block"><span class="notification-list-user-name">{{$item->users->name}}</span>Obat {{$item->barang->nama}} habis pada hari ini!
      <div class="notification-date">{{$item->tgl_habis}}</div>
    </div>
  </div>
</a>
@endforeach