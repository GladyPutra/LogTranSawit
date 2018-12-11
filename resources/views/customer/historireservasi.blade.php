@extends('layouts.masterCustomer')
@section('custom_css')
@endsection

@section('title')
	HISTORI RESERVASI
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
                    <a href="{{ route('customer.datareservasi') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="table-responsive">
                @if($reservasi->count())
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>ID BOOKING</th>
                            <th>NAMA KAMAR</th>
                            <th>KOTA</th>
                            <th>TGL RESERVASI</th>
                            <th>TGL PEMESANAN</th>
                            <th>KONTROL</th>
                        </tr>
                        </thead>
                        @foreach($reservasi as $data)
                        <tbody>
                        <tr>
                            <td class="center">{{ $data->ID_BOOKING }}</td>
                            <td>{{ $data->reservasi->kamar->detilkamar['NAMA_KAMAR'] }} ({{ $data->reservasi->kamar['ID_KAMAR'] }})</td>
                            <td class="center">{{ $data->reservasi->kota['NAMA_KOTA'] }}</td>
                            <td>{{ date("d-M-Y h:m:s", strtotime($data->reservasi['TGL_RESERVASI'])) }}</td>
                            <td>{{ date("d-M-Y", strtotime($data->reservasi['TGL_MENGINAP'])) }}</td>
                            <td>
                                <form method="POST" action="{{ route('customer.hapushistorireservasi', $data->ID_BOOKING) }}" accept-charset="UTF-8">
                                  <input name="_method" type="hidden" value="DELETE">
                                  <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <a href="{{ route('customer.detilreservasi', $data->ID_DETIL_RESERVASI) }}" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i> Detil</a>
                                    <input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Ingin Mengapus Histori Reservasi?');" value="Hapus">
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
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection

@section('custom_script')
@endsection