<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Atma Hotel</title>
    <!-- Core CSS - Include with every page -->
    <link href="{{ asset('template/admin/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/admin/plugins/pace/pace-theme-big-counter.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/admin/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/admin/css/main-style.css') }}" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="{{ asset('template/admin/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('template/sweetalert/dist/sweetalert.css') }}">

    @yield('custom_css')

   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="assets/img/logo.png" alt="" />
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li><a href="{{ route('dashboard') }}"></i>Selamat Datang di Halaman Reservasi </a></li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li><a href="{{ route('reservasinonlogin.reservasi') }}"><i class="fa fa-file fa-fw"></i> DATA RESERVASI</a></li>
                    <li><a href="{{ route('home') }}"><i class="fa fa-arrow-left fa-fw"></i> BATAL</a></li>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">
                    	<!------------------------------------------------------ TITLE -------------------------------->
                		@yield('title') 
                    </h1>
                </div>
                <!--End Page Header -->
                <div>
                	<!------------------------------------------------------ CONTENT -------------------------------->
                	@yield('content') 
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="{{ asset('template/admin/plugins/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/pace/pace.js') }}"></script>
    <script src="{{ asset('template/admin/scripts/siminta.js') }}"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="{{ asset('template/admin/plugins/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/morris/morris.js') }}"></script>
    <script src="{{ asset('template/admin/scripts/dashboard-demo.js') }}"></script>
    <script src="{{ asset('template/sweetalert/sweetalert.js') }}"></script>
    @include('sweet::alert')
    @yield('custom_script')
</body>

</html>
