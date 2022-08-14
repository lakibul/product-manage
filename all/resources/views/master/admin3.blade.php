<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Manage</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/')}}admin3/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('/')}}admin3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/')}}admin3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('/')}}admin3/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/')}}admin3/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('/')}}admin3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('/')}}admin3/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('/')}}admin3/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('/')}}admin3/dist/img/AdminLTELogo.png" alt="" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light mb-3">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Notifications Dropdown Menu -->
            @if(Auth::guard('merchant')->check())
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        @if(Auth::guard('merchant')->user()->unreadNotifications->count())
                            <span class="badge badge-warning navbar-badge">{{Auth::guard('merchant')->user()->unreadNotifications->count()}}</span>
                        @endif
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" style="color: green" href="{{ route('mark.read') }}">Mark all
                                as Read</a></li>
                        @foreach(Auth::guard('merchant')->user()->unreadNotifications as $notify)
                            <li><a style="background-color: #7abaff" class="dropdown-item"
                                   href="#">{{$notify->data['data']}}</a></li>
                        @endforeach
                        @foreach(Auth::guard('merchant')->user()->readNotifications as $notify)
                            <li><a class="dropdown-item" href="#">{{$notify->data['data']}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif

            <!-- Profile Menu -->
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::guard('merchant')->user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                        <form action="{{route('logout')}}" method="POST" id="logoutForm">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

{{--    <!-- Main Sidebar Container -->--}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        @if(Auth::guard('admin')->check())
            <a href="{{url('/admin')}}" class="brand-link">
                <img src="{{asset('/')}}admin3/dist/img/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Product Manage</span>
            </a>
        @else
            <a href="{{url('/merchant')}}" class="brand-link">
                <img src="{{asset('/')}}admin3/dist/img/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Product Manage</span>
            </a>
        @endif

{{--        <!-- Sidebar -->--}}
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('/')}}admin3/dist/img/logo1.png" class="img-circle elevation-2" alt="">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::guard('merchant')->user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Customer Module
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('customer.manage')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                Product Module
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('product.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product Index</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::guard('merchant')->check())
                        <li class="nav-item">
                            <a href="{{route('inventory.index')}}" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Inventory
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('disable.index')}}" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Disable Product
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('log.merchant')}}" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Activity Log
                                </p>
                            </a>
                        </li>
                    @endif

                    @if(Auth::guard('admin')->check())
                        <li class="nav-item">
                            <a href="{{route('log.admin')}}" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Activity Log
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
{{--        <!-- /.sidebar -->--}}
    </aside>

{{--    <!-- Content Wrapper. Contains page content -->--}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <div class="content-cell">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
{{--    <!-- /.content-wrapper -->--}}
    <footer class="main-footer">
        <strong>Copyright &copy;  <a href="#">Md Lakibul Hasan</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.3
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
{{--    <!-- /.control-sidebar -->--}}
</div>
{{--<!-- ./wrapper -->--}}

<!-- jQuery -->
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}

<script src="{{asset('/')}}admin3/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/')}}admin3/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('/')}}admin3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('/')}}admin3/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('/')}}admin3/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('/')}}admin3/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('/')}}admin3/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/')}}admin3/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('/')}}admin3/plugins/moment/moment.min.js"></script>
<script src="{{asset('/')}}admin3/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('/')}}admin3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('/')}}admin3/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('/')}}admin3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}admin3/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/')}}admin3/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('/')}}admin3/dist/js/pages/dashboard.js"></script>
</body>
</html>
