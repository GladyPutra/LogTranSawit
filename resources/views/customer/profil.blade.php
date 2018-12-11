@extends('layouts.masterCustomer')
@section('custom_css')
@endsection

@section('title')
	PROFIL
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
                            <td>@if($profil != null) {{ $profil->NAMA }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">NO. IDENTITAS</td>
                            <td>@if($profil != null) {{ $profil->NO_IDENTITAS }} @endif</td>
                        </tr>   
                        <tr>
                            <td width="200px">JENIS KELAMIN</td>
                            <td>@if($profil != null) {{ $profil->JENIS_KELAMIN }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">INSTITUSI</td>
                            <td>@if($profil != null) {{ $profil->NAMA_INSTITUSI }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">NO. TELP</td>
                            <td>@if($profil != null) {{ $profil->NO_TELEPON }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">EMAIL</td>
                            <td>@if($profil != null) {{ $profil->EMAIL }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">ALAMAT</td>
                            <td>@if($profil != null) {{ $profil->ALAMAT }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">TGL PENDAFTARAN</td>
                            <td>@if($profil != null) {{ $profil->TGL_BUAT }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">EMAIL</td>
                            <td>@if($profil != null) {{ $profil->EMAIL }} @endif</td>
                        </tr>
                        <tr>
                            <td width="200px">USERNAME</td>
                            <td>@if($profil != null) {{ Session::get('username') }} @endif</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('customer.ubah', $profil->ID_DATA_DIRI) }}" class="btn btn-default"><i class="fa fa-edit"></i> Ubah</a>
                </div>
            </div>
        </div>    
    <!--End Advanced Tables -->
    </div>
</div>
@endsection

@section('custom_script')
@endsection