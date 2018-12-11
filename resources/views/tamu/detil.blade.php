@extends('layouts.masterCustomer')
@section('custom_css')
@endsection

@section('title')
	DETIL CUSTOMER
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
                    <!--  -->
                </div>
                <div class="col-sm-12">
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <th colspan="2">DATA DIRI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px">NAMA LENGKAP</td>
                            <td>@if($tamu != null) {{ $tamu->NAMA }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">NO. IDENTITAS</td>
                            <td>@if($tamu != null) {{ $tamu->NO_IDENTITAS }} @endif</td>
                        </tr>   
                        <tr>
                            <td width="200px">JENIS KELAMIN</td>
                            <td>@if($tamu != null) {{ $tamu->JENIS_KELAMIN }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">INSTITUSI</td>
                            <td>@if($tamu != null) {{ $tamu->NAMA_INSTITUSI }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">NO. TELP</td>
                            <td>@if($tamu != null) {{ $tamu->NO_TELEPON }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">EMAIL</td>
                            <td>@if($tamu != null) {{ $tamu->EMAIL }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">ALAMAT</td>
                            <td>@if($tamu != null) {{ $tamu->ALAMAT }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">TGL PENDAFTARAN</td>
                            <td>@if($tamu != null) {{ $tamu->TGL_BUAT }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">EMAIL</td>
                            <td>@if($tamu != null) {{ $tamu->EMAIL }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">USERNAME</td>
                            <td>@if($tamu != null) {{ $tamu->user['USERNAME'] }} @endif</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('tamu.tampil') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>    
    <!--End Advanced Tables -->
    </div>
</div>
@endsection

@section('custom_script')
@endsection