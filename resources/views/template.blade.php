<!doctype html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Manajemen Toko Sederahana</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
  <link href="{{ asset('assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">awesome-all.css')}}">
  
  {{-- SELECT SEARCH BOX --}}
  <link href="{{ asset('assets/select2/select2.min.css')}}" rel="stylesheet" />
</head>

<body>
  <!-- ============================================================== -->
  <!-- main wrapper -->
  <!-- ============================================================== -->
  <div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
      <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <a class="navbar-brand" href="index.html">Sistem Manajemen Toko Sederahana</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto navbar-right-top">
            <li class="nav-item dropdown notification">
              <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span
                  class="indicator"></span></a>
              <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                <li>
                  <div class="notification-title"> Notification</div>
                  <div class="notification-list">
                    <div class="list-group">
                      <a href="#" class="list-group-item list-group-item-action active">
                        <div class="notification-info">
                          <div class="notification-list-user-img"><img src="assets/images/avatar-2.jpg" alt=""
                              class="user-avatar-md rounded-circle"></div>
                          <div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy
                              Rakestraw</span>accepted your invitation to join the team.
                            <div class="notification-date">2 min ago</div>
                          </div>
                        </div>
                      </a>
                      <a href="#" class="list-group-item list-group-item-action">
                        <div class="notification-info">
                          <div class="notification-list-user-img"><img src="assets/images/avatar-3.jpg" alt=""
                              class="user-avatar-md rounded-circle"></div>
                          <div class="notification-list-user-block"><span class="notification-list-user-name">John
                              Abraham </span>is now following you
                            <div class="notification-date">2 days ago</div>
                          </div>
                        </div>
                      </a>
                      <a href="#" class="list-group-item list-group-item-action">
                        <div class="notification-info">
                          <div class="notification-list-user-img"><img src="assets/images/avatar-4.jpg" alt=""
                              class="user-avatar-md rounded-circle"></div>
                          <div class="notification-list-user-block"><span class="notification-list-user-name">Monaan
                              Pechi</span> is watching your main repository
                            <div class="notification-date">2 min ago</div>
                          </div>
                        </div>
                      </a>
                      <a href="#" class="list-group-item list-group-item-action">
                        <div class="notification-info">
                          <div class="notification-list-user-img"><img src="assets/images/avatar-5.jpg" alt=""
                              class="user-avatar-md rounded-circle"></div>
                          <div class="notification-list-user-block"><span class="notification-list-user-name">Jessica
                              Caruso</span>accepted your invitation to join the team.
                            <div class="notification-date">2 min ago</div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="list-footer"> <a href="#">View all notifications</a></div>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown nav-user">
              {{-- <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt=""
                  class="user-avatar-md rounded-circle"></a>
              <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                aria-labelledby="navbarDropdownMenuLink2">
                <div class="nav-user-info">
                  <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                  <span class="status"></span><span class="ml-2">Available</span>
                </div>
                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
              </div> --}}

              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
      <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav flex-column">
              <li class="nav-divider">
                Menu
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('/') }}" data-toggle="collapse" aria-expanded="false"
                  data-target="#submenu-10" aria-controls="submenu-10"><i
                    class="fas fa-fw fa-user-circle"></i>Dashboard</a>
                <div id="submenu-10" class="collapse submenu" style="">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuHomepage')" href="{{ url('/') }}">HomePage</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false"
                  data-target="#submenu-11" aria-controls="submenu-10"><i class="fas fa-shipping-fast"></i>Manajemen
                  Supplier</a>
                <div id="submenu-11" class="collapse submenu" style="">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuInputSupplier')" href="{{ url('sup/showinput') }}">Input
                        Supplier</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuListSupplier')" href="{{ url('sup/showlist') }}">List
                        Supplier</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false"
                  data-target="#submenu-12" aria-controls="submenu-10"><i class="fas fa-box"></i>Manajemen Barang</a>
                <div id="submenu-12" class="collapse submenu" style="">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuInputBarang')" href="{{ url('bar/showinput') }}">Input
                        Barang</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuListBarang')" href="{{ url('bar/showlist') }}">List
                        Barang</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false"
                  data-target="#submenu-13" aria-controls="submenu-10"><i class="fas fa-shopping-cart"></i>Manajemen
                  Pembelian</a>
                <div id="submenu-13" class="collapse submenu" style="">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuInputPembelian')" href="{{ url('pemb/showinput') }}">Beli
                        Barang</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuListPembelian')" href="{{ url('pemb/showlist') }}">List
                        Pembelian</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false"
                  data-target="#submenu-13" aria-controls="submenu-10"><i class="fas fa-shopping-cart"></i>Manajemen
                  Member</a>
                <div id="submenu-13" class="collapse submenu" style="">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuInputMember')" href="{{ url('pemb/showinput') }}">Input Member</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @yield('activeMenuListMember')" href="{{ url('pemb/showlist') }}">List Member</a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
      <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
              <h2 class="pageheader-title">@yield('title') </h2>
              <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                    @yield('mainMenu')
                    {{-- <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">@yield('mainMenu')</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">@yield('subMenu')</li> --}}
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row">
          @yield('content')
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <div class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
              Copyright © 2018 Concept. All rights reserved. Dashboard by <a
                href="https://colorlib.com/wp/">Colorlib</a>.
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
              <div class="text-md-right footer-links d-none d-sm-block">
                <a href="javascript: void(0);">About</a>
                <a href="javascript: void(0);">Support</a>
                <a href="javascript: void(0);">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- end footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- end main wrapper -->
  <!-- ============================================================== -->
  <!-- Optional JavaScript -->
  <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
  <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
  <script src="{{ asset('assets/libs/js/main-js.js')}}"></script>
  <script src="{{ asset('assets/vendor/parsley/parsley.js')}}"></script>
</body>

</html>