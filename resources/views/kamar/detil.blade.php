@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	DETIL KAMAR
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
                    <a href="{{ route('kamar.tampil') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-sm-12">
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <tbody>
                        <tr>
                            <td width="150px">Id Kamar</td>
                            <td>{{ $kamar->ID_KAMAR }}</td>
                        </tr>
                        <tr>
                            <td>Nama Kamar</td>
                            <td>{{ $kamar->detilkamar['NAMA_KAMAR'] }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Tidur</td>
                            <td>{{ $kamar->TEMPAT_TIDUR }}</td>
                        </tr>
                        <tr>
                            <td>Smoking</td>
                            <td>{{ $kamar->STAUS_SMOKING }}</td>
                        </tr>
                        <tr>
                            <td>Booking</td>
                            <td>{{ $kamar->STATUS_BOOKING }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Kamar</td>
                            <td>{{ $kamar->detilkamar['JUMLAH_KAMAR'] }}</td>
                        </tr>
                        <tr>
                            <td>Fasilitas Kamar</td>
                            <td>{{ $kamar->detilkamar['FASILITAS'] }}</td>
                        </tr>
                        <tr>
                            <td>Harga Kamar</td>
                            <td>Rp. {{number_format($kamar->tarifkamar['HARGA_KAMAR'], 2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td>Season Kamar</td>
                            <td>{{ $kamar->tarifkamar->season['NAMA_SEASON'] }}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection

@section('custom_script')
@endsection