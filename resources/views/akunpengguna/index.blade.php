@extends('layouts.master')
@section('custom_css')

@endsection

@section('title')
	PENGELOLAAN AKUN PEGAWAI
@endsection

@section('content')
<div class="col-lg-12">
@if(count($errors)>0)
    <ul>
        @foreach($errors->all() as $error)

            <li class="alert alert-danger">{{$error}}</li>

        @endforeach
    </ul>
@endif
    <div class="panel panel-default">
        <div class="panel-heading">
        <!--  -->
        </div>
        <div class="col-lg-6">

        </div>

        <div class="panel-body">
                <div class="col-sm-4 col-xs-8 form-group">
                    <!-- <a href="" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a> -->
                    <a href="{{ route('pegawai.tampil') }}" class="btn btn-success"><i class="fa fa-refresh"></i> Segarkan</a>

                </div>
                {!! Form::open(['method'=>'GET','url'=>'/pegawai/cari'])  !!}
                <div class="col-sm-4 col-xs-8 form-group pull-right input-group">
                    <input type="text" name="katakunci" class="form-control" placeholder="Pencarian...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                {!! Form::close() !!}
								<div class="row">
									<table id="tables" class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
											<tr>
													<th>NAMA PEGAWAI</th>
													<th>EMAIL</th>
													<th>NOMOR HP</th>
													<th>PERAN</th>
													<th>KONTROL</th>
											</tr>
											</thead>
											@foreach($user as $data)
											<tbody>
											<tr>
													<td>{{ $data->nama }}</td>
													<td>{{ $data->email }}</td>
													<td>{{ $data->no_hp }}</td>
													<td>{{ $data->role['deskripsi'] }}</td>
													<td width="250px">
															<form method="POST" action="{{ route('pegawai.hapus', $data->id_user) }}" accept-charset="UTF-8">
																<input name="_method" type="hidden" value="DELETE">
																<input name="_token" type="hidden" value="{{ csrf_token() }}">
																	<a href="{{ route('pegawai.ubah', $data->id_user) }}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Ubah</a>
																	<a href="{{ route('pegawai.resetpassword', $data->id_user) }}" class="btn btn-primary btn-xs"
																	onclick="return confirm('Apakah Anda Yakin Ingin Atur Ulang Kata Sandi?');" ><i class="fa fa-key"></i> Atur Kata Sandi</a>
																	<input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Ingin Menghapus Akun Pengguna?');" value="Hapus">
															</form>
													</td>
											</tr>
											</tbody>
											@endforeach
									</table>
								</div>
                <div class="table-responsive">
                @if($user->count())

                </div>
                {!! $user->links() !!}
                @else
                <div class="alert">
                    <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
                </div>
                @endif
            </div>
        <div class="col-sm-12">
                <table class="table table-striped table-bordered" id="dataTables-example">
                <form class="form_isi" action="" method="post" role="form">

                    <thead>
                        <tr>
                            <th colspan="2">Kelola Akun</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px">NAMA PENGGUNA</td>
                            @if(isset($dataUser))
                                 <td><input id="txtuseredit" value="{{ $dataUser->username }}" type="text" class="form-control" name="username" placeholder="Masukkan Nama Pengguna"/>

                                 </td>
                            @else
                                <td><input id="txtusersimpan" value="" type="text" class="form-control" name="username" placeholder="Masukkan Nama Pengguna"></td>
                            @endif
                        </tr>
                        <tr>
                            <td width="200px">Kata Sandi</td>
                            <td><input type="password"class="form-control" name="password" placeholder="Masukkan Kata Sandi"
                                value="<?php if($dataUser!=null) echo $dataUser->password; else ""; ?>" required></td>
                        </tr>
                        <tr>
                            <td width="200px">NAMA LENGKAP</td>
                            <td><input type="text"class="form-control" name="nama" placeholder="Masukkan Nama Lengkap"
                                value="<?php if($dataUser!=null) echo $dataUser->nama; else ""; ?>" required></td>
                        </tr>
                        <tr>
                            <td width="200px">EMAIL</td>
                            <td><input type="text"class="form-control" name="email" placeholder="Masukkan Email"
                                value="<?php if($dataUser!=null) echo $dataUser->email; else ""; ?>" required></td>
                        </tr>
                        <tr>
                            <td width="200px">NOMOR HP</td>
                            <td><input type="text"class="form-control" name="no_hp" placeholder="Masukkan Nomor HP"
                                value="<?php if($dataUser!=null) echo $dataUser->no_hp; else ""; ?>" required></td>
                        </tr>
                        <tr>
                            <td width="200px">PERAN</td>
                            <td><select class="form-control" name="role">
                                    @foreach ($role as $data)
                                        <option value="{{ $data->id_role }}" <?php if($dataUser!=null&&$dataUser->id_role == $data->id_role) echo "Selected";?>>{{ $data->deskripsi }}</option>
                                    @endforeach
                                </select></td>
                        </tr>

                        {{csrf_field()}}
                    </tbody>
                     <table>
                            @if(isset($flag) && isset($dataUser))
                                <td>&emsp;<button class="btn btn-primary btnedit" value="{{ route('pegawai.doedit',$dataUser->id_user) }}">Simpan</button></td>

                            @else
                                <td>&emsp;<button class="btn btn-primary btnsimpan" value="{{ route('pegawai.simpan') }}" ><i class="fa fa-save fa-fw"></i>Simpan</button></td>
                            @endif

                            <td>&emsp;<a href="{{ route('pegawai.tampil') }}" class="btn btn-danger">Batal</a></td>
                        </table>
                    </form>
                </table>
                </div>
    </div>
</div>
    <script src="{{ asset('template/admin/plugins/jquery-1.10.2.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

$('.btnedit').click(function(e){
    e.preventDefault();
    $.ajax({
        type: 'get',
        url : '../../username-exist/'+$("#txtuseredit").val(),
        success : function(data){

                $('.form_isi').attr('action',$(".btnedit").val());
                $('.form_isi').append('{{ method_field("PATCH") }}');
                $('.form_isi').submit();
        }
    });
});
$('.btnsimpan').click(function(e){
    e.preventDefault();
    $.ajax({
        type: 'get',
        url : 'username-exist/'+$("#txtusersimpan").val(),
        success : function(data){
            if(data == "sukses")
            {
                $('.form_isi').attr('action',$(".btnsimpan").val());
                $('.form_isi').submit();
            }
            else
            {
                alert("Nama Pengguna Sudah Ada !")
            }
            // if(data == "sukses")
            // {
            //     alert("Username udah ada")
            // }
            // else
            // {
            //      $('.form_isi').attr('action',$(this).val());
            //     $('.form_isi').submit();
            // }
        }
    });
});
</script>
@endsection

@section('custom_script')

@endsection
