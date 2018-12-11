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
            
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <!-- navbar side -->
        
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">
                    	
                    </h1>
                </div>
                <!--End Page Header -->
                <div>
                	<div class="row">
                        <div class="col-lg-12">
                        <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a target="_blank" href="{{ route('customer.export_cetaknota', $reservasi->ID_BOOKING) }}" class="btn btn-success"><i class="fa fa-print"></i> Export</a>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-4 col-xs-8 form-group">
                                        <label>Tanggal : {{ DATE('d-M-Y') }}</label>
                                    </div>
                                    <div class="col-sm-12">
                                    <table class="table table-striped table-bordered" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th colspan="2">TANDA TERIMA PEMESANAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="200px">ID BOOKING</td>
                                                <td>{{ $reservasi->ID_BOOKING }}</td>
                                            </tr>
                                            <tr>
                                                <td width="200px">NAMA</td>
                                                <td>{{ $reservasi->datadiri['NAMA'] }}</td>
                                            </tr>
                                            <tr>
                                                <td width="200px">ALAMAT</td>
                                                <td>{{ $reservasi->datadiri['ALAMAT'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-bordered" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th colspan="2" align="center">DETIL PEMESANAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="200px">Check In</td>
                                                <td>{{ date("d-M-Y", strtotime($reservasi->checkinout['TGL_CHECKIN'])) }}</td>
                                            </tr>                        
                                            <tr>
                                                <td width="200px">Check Out</td>
                                                <td>{{ date("d-M-Y", strtotime($reservasi->checkinout['TGL_CHECKOUT'])) }}</td>
                                            </tr>
                                            <tr>
                                                <td width="200px">Dewasa</td>
                                                <td>{{ $reservasi->detilreservasi['JUMLAH_DEWASA'] }}</td>
                                            </tr>
                                            <tr>
                                                <td width="200px">Anak-Anak</td>
                                                <td>{{ $reservasi->detilreservasi['JUMLAH_ANAK'] }}</td>
                                            </tr>
                                            <tr>
                                                <td width="200px">Tgl Pembayaran</td>
                                                <td>{{ date("d-M-Y", strtotime($reservasi->transaksi['TGL_TRANSAKSI'])) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="table-responsive">
                                    @if($reservasi->count())
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                            <tr>
                                                <th colspan="5"></th>
                                            </tr>
                                            <tr>
                                                <th>JENIS KAMAR</th>
                                                <th>BED</th>
                                                <th>JUMLAH</th>
                                                <th>HARGA</th>
                                                <th>TOTAL</th>
                                            </tr>
                                            </thead>
                                            <?php $total = 0; ?>
                                            @foreach($kamar as $data)
                                            <tbody>
                                            <tr>
                                                <?php 
                                                    $subtotal = $data->tarifkamar['HARGA_KAMAR'] * $data->reservasi->detilreservasi['JUMLAH_KAMAR'];
                                                    $total = $total + $subtotal; 
                                                ?>
                                                <td>{{ $data->detilkamar['NAMA_KAMAR'] }}</td>
                                                <td>{{ $data->TEMPAT_TIDUR }}</td>
                                                <td>{{ $data->reservasi->detilreservasi['JUMLAH_KAMAR'] }}</td>
                                                <td align="right">Rp. {{number_format($data->tarifkamar['HARGA_KAMAR'], 2, ',', '.')}}</td>
                                                <td align="right">Rp. {{number_format($subtotal, 2, ',', '.')}}</td>
                                            </tr>
                                            </tbody>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" align="right">TOTAL</td>
                                                <td align="right" style="font-weight: bold;">Rp. {{number_format($total, 2, ',', '.')}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
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
