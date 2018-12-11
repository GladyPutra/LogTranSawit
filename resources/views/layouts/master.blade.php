<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogTranSawit</title>
    <link rel="icon" href="logoa.png"/>
    <!-- Core CSS - Include with every page -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset('template/admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/admin/plugins/pace/pace-theme-big-counter.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/admin/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/admin/css/main-style.css') }}" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="{{ asset('template/admin/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('template/sweetalert/dist/sweetalert.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


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
            <ul class="nav navbar-top-links navbar-left">
                <!-- main dropdown -->
                <li><img src="{{asset('/logo2.png')}}" alt="" height="60" width="140"/></li>
                <!-- end main dropdown -->
            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-user fa-fw"></i>Selamat Datang, {{ \Auth::user()->username }} | </a></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i>Keluar</a></li>
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

                    @if(\Auth::user()->id_role == 1)
                    	  <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Beranda</a></li>
                        <li><a href="{{ route('pegawai.tampil') }}"><i class="fa fa-user fa-fw"></i> Akun Pegawai</a></li>
                        <li><a href="{{ route('tampilpeta') }}"><i class="fa fa-map-marker"></i> Kebun / Afdeling</a></li>
                    @elseif(\Auth::user()->id_role == 2 || \Auth::user()->id_role == 3 || \Auth::user()->id_role == 4 ||\Auth::user()->id_role == 7)
                        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Beranda</a></li>
                        @if(\Auth::user()->id_role == 2 || \Auth::user()->id_role == 3 || \Auth::user()->id_role == 4 )
                        <!-- <li><a href="{{ route('dashboard') }}"><i class="fa fa-map-marker"></i> Taksasi</a></li> -->
                        <li><a href="{{ route('tampilpeta2') }}"><i class="fa fa-map-marker"></i> Peta</a></li>
                        @elseif(\Auth::user()->id_role == 7)
                        <li><a href="{{ route('peta-krani') }}"><i class="fa fa-map-marker"></i> Peta</a></li>

                        @endif
                    @elseif(\Auth::user()->id_role == 6 || \Auth::user()->id_role == 5)
                    	<li><a href="{{ route('managerpabrikberanda') }}"><i class="fa fa-dashboard fa-fw"></i> Beranda</a></li>
                      <li><a href="{{ route('kelolakapasitas') }}"><i class="fa fa-dashboard fa-fw"></i> Kelola Kapasitas</a></li>
                      <li><a href="{{ route('kelolashift') }}"><i class="fa fa-dashboard fa-fw"></i> Kelola Shift</a></li>
                      <li><a href="{{ route('displayangkut') }}"><i class="fa fa-dashboard fa-fw"></i> Tampil Panen / Angkat</a></li>
                      <li><a href="{{ route('displaydistribusi') }}"><i class="fa fa-dashboard"></i> Tampil Distribusi Angkut</a></li>
                      <li><a href="{{ route('tanggaldistribusi') }}"><i class="fa fa-dashboard"></i> Histori Distribusi Angkut</a></li>
                      @elseif(\Auth::user()->id_role == 8)
                        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Beranda</a></li>
                    @endif
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
