@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	RESERVASI KAMAR
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
    <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <!--  -->
            </div>
            <div class="panel-body">
                <div class="col-sm-4 col-xs-8 form-group">
                    <!-- <a href="" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a> -->
                    <a href="{{ route('reservasi.tampil') }}" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>
                    <a href="{{ route('reservasi.history') }}" class="btn btn-warning"><i class="fa fa-folder"></i> Riwayat</a>
                    
                </div>
                {!! Form::open(['method'=>'GET','route'=>'reservasi.cari'])  !!}
                <div class="col-sm-4 col-xs-8 form-group pull-right input-group">
                    <input type="text" name="katakunci" class="form-control" placeholder="Pencarian...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                @if($reservasi->count())
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>ID BOOKING</th>
                            <th>NAMA KAMAR</th>
                            <th>PEMESAN</th>
                            <th>KOTA</th>
                            <th>TGL RESERVASI</th>
                            <th>STATUS</th>
                            <th>KONTROL</th>
                        </tr>
                        </thead>
                        @foreach($reservasi as $data)
                        <tbody>
                        <tr>
                            <td class="center">{{ $data->reservasi['ID_BOOKING'] }}</td>
                            <td>{{ $data->reservasi->kamar->detilkamar['NAMA_KAMAR'] }} ({{ $data->reservasi['ID_KAMAR'] }})</td>
                            <td>{{ $data->reservasi->datadiri['NAMA'] }} ({{ $data->reservasi->datadiri['NO_IDENTITAS'] }})</td>
                            <td class="center">{{ $data->reservasi->kota['NAMA_KOTA'] }}</td>
                            <td>{{ $data->reservasi['TGL_RESERVASI'] }}</td>
                            <td>{{ $data->reservasi->transaksi['JENIS_STATUS'] }}</td>
                            <td>
                                <form method="POST" action="{{ route('reservasi.batal', $data->ID_DETIL_RESERVASI) }}" accept-charset="UTF-8">
                                  <input name="_method" type="hidden" value="DELETE">
                                  <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <a href="{{ route('reservasi.detil', $data->ID_DETIL_RESERVASI) }}" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i> Detil</a>
                                    <a href="{{ route('reservasi.ubah', $data->ID_DETIL_RESERVASI) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Ubah</a>
                                    <input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Ingin Membatalkan Reservasi?');" value="Batal">
                                </form>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                {!! $reservasi->links() !!}
                @else
                <div class="alert">
                    <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
                </div>
                @endif

                </br> <b>TAMBAH RESERVASI : </b>
                {!! Form::open(['method'=>'GET','route'=>'reservasi.caricustomer'])  !!}
                <div class="col-sm-6 col-xs-10 form-group pull-left input-group">
                    <input type="text" name="caricustomer" class="form-control" placeholder="Masukkan Nama atau No. Identitas Customer...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Tambahkan</button>
                    </span>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                @if($customer != null)
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAMA TAMU</th>
                            <th>NO IDENTITAS</th>
                            <th>EMAIL</th>
                            <th>INSTITUSI</th>
                            <th>NO. TELP</th>
                            <th>USERNAME</th>
                            <th>KONTROL</th>
                        </tr>
                        </thead>
                        @foreach($customer as $data)
                        <tbody>
                        <tr>
                            <td class="center" width="50px">{{ $data->ID_DATA_DIRI }}</td>
                            <td>{{ $data->NAMA }}</td>
                            <td>{{ $data->NO_IDENTITAS }}</td>
                            <td>{{ $data->EMAIL }}</td>
                            <td>{{ $data->NAMA_INSTITUSI }}</td>
                            <td>{{ $data->NO_TELEPON }}</td>
                            <td>{{ $data->user['USERNAME'] }}</td>
                            <td width="130px">
                               <a href="{{ route('reservasi.tambah', $data->ID_DATA_DIRI) }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Reservasi</a>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAMA TAMU</th>
                            <th>NO IDENTITAS</th>
                            <th>EMAIL</th>
                            <th>INSTITUSI</th>
                            <th>NO. TELP</th>
                            <th>USERNAME</th>
                            <th>KONTROL</th>
                        </tr>
                        </thead>
                    </table>
                    <a href="{{ route('reservasi.tampil') }}" class="btn btn-xs btn-danger"><i class="fa fa-cancel"></i> Batal</a>
                </div>
                @endif
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection

@section('custom_script')
@endsection