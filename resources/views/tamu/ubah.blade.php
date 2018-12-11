@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
    UBAH TAMU
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <!--  -->
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table table-striped table-bordered" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th colspan="2">DATA DIRI</th>
                                </tr>
                            </thead>
                            <tbody>
                            {!! Form::model($tamu, ['route'=>['tamu.simpanperubahan', $tamu->ID_DATA_DIRI], 'method'=> 'PATCH', 'role'=>'form'])  !!}
                                <form>
                                    <tr>
                                        <td width="200px">NAMA LENGKAP</td>
                                        <td width="300px"><input class="form-control" name="nama" value="{{ $tamu->NAMA }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">NO. IDENTITAS</td>
                                        <td width="300px"><input class="form-control" name="no_identitas" value="{{ $tamu->NO_IDENTITAS }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">JENIS KELAMIN</td>
                                        <td width="300px">
                                            <input type="radio" name="kelamin" id="optionsRadiosInline1" value="Laki-laki" <?php if($tamu->JENIS_KELAMIN == "Laki-laki") echo "checked"; ?>> Laki-laki &emsp;
                                            <input type="radio" name="kelamin" id="optionsRadiosInline2" value="Perempuan" <?php if($tamu->JENIS_KELAMIN == "Perempuan") echo "checked"; ?>> Perempuan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200px">NAMA INSTITUSI</td>
                                        <td width="300px"><input class="form-control" name="institusi" value="{{ $tamu->NAMA_INSTITUSI }}"></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">NO. TELP</td>
                                        <td width="300px"><input class="form-control" name="telp" value="{{ $tamu->NO_TELEPON }}"></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">EMAIL</td>
                                        <td width="300px"><input class="form-control" name="email" value="{{ $tamu->EMAIL }}"></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">ALAMAT</td>
                                        <td width="300px"><textarea class="form-control" name="alamat" required>{{ $tamu->ALAMAT }}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td width="200px">KATEGORI</td>
                                        <td width="300px"><input class="form-control" value="<?php if($tamu->ID_USER != null) echo "Personal"; else echo "Grup"; ?>" disabled></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
                                            <a href="{{ route('tamu.tampil') }}" class="btn btn-danger"> Batal</a>
                                        </td>
                                    </tr>
                                </form>
                                {!! Form::close() !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Form Elements -->
    </div>
</div>

@endsection

@section('custom_script')
@endsection