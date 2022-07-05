<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/')}}css/favicon.ico">
    <!-- DataTables -->
{{--    <link href="{{asset('/')}}admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{asset('/')}}admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />--}}

<!-- Responsive datatable examples -->
{{--    <link href="{{asset('/')}}admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />--}}
<!-- Bootstrap Css -->
    <link href="{{asset('/')}}css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}
    <!-- Icons Css -->
    <link href="{{asset('/')}}css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('/')}}css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    {{--    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">--}}

    <link href="{{asset('/')}}css/style.css" rel="stylesheet"/>
    <link href="{{asset('/')}}css/inventory.css" rel="stylesheet"/>
    <script src="{{asset('/')}}js/plugin.bundle.js"></script>



</head>

<body data-sidebar="dark">

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('/')}}admin/images/logo.svg" alt="" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('/')}}admin/images/logo-dark.png" alt="" height="17">
                                </span>
                    </a>

                    <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('/')}}admin/images/logo-light.svg" alt="" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('/')}}admin/images/logo-light.png" alt="" height="19">
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="bx bx-search-alt"></span>
                    </div>
                </form>


            </div>

            <div class="d-flex">



                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-xl-inline-block ml-1">{{Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::guard('merchant')->user()->name}}</span>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                        <form action="{{route('logout')}}" method="POST" id="logoutForm">
                            @csrf
                        </form>
                    </div>
                </div>
                <div>
                    <a class="dropdown-item text-danger" style="margin-top: 30px;" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                    <form action="{{route('logout')}}" method="POST" id="logoutForm">
                        @csrf
                    </form>
                </div>



            </div>
        </div>
    </header> <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>

                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right">03</span>
                            <span>Dashboards</span>
                        </a>

                    </li>

                    {{--   <li>
                           <a href="javascript: void(0);" class="has-arrow waves-effect">
                               <i class="bx bx-briefcase-alt-2"></i>
                               <span>User Module</span>
                           </a>
                           <ul class="sub-menu" aria-expanded="false">
                               <li><a href="#">Add User</a></li>
                               <li><a href="#">Manage User</a></li>
                           </ul>
                       </li> --}}

                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-briefcase-alt-2"></i>
                            <span>Customer Module</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            {{--                            <li><a href="{{route('customer.add')}}">Add Customer</a></li>--}}
                            <li><a href="{{route('customer.manage')}}"><small><i class="fa fa-adjust"></i>Manage Customer</small></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-briefcase-alt-2"></i>
                            <span>Product Module</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('product.index')}}"><small><i class="fa fa-adjust"></i>Product Index</small></a></li>
{{--                            <li><a href="{{route('inventory')}}">Inventory</a></li>--}}
                        </ul>
                    </li>

                    @if(Auth::guard('merchant')->check())
                    <li>
                        <a href="{{route('inventory.index')}}" class="waves-effect">
                            <i class="bx bx-briefcase-alt-2"></i>
                            <span>Inventory</span>
                        </a>
                    </li>

                        <li>
                            <a href="{{route('disable.index')}}" class="waves-effect">
                                <i class="bx bx-briefcase-alt-2"></i>
                                <span>Disable Product</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- End Page-content -->




    </div>

    <!-- end main content-->

</div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Skote.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Md Lakibul Hasan
                    </div>
                </div>
            </div>
        </div>
    </footer>

<!-- END layout-wrapper -->



<!-- JAVASCRIPT -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- Responsive examples -->
{{--<script src="{{asset('/')}}admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>--}}
{{--<script src="{{asset('/')}}admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>--}}



<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
