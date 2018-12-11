@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	UBAH TIPE KAMAR
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
                    <div class="col-lg-12">
                        <table class="table table-striped table-bordered" id="dataTables-example">
                            <tbody>
                                {!! Form::model($kamar, ['route'=>['tipekamar.simpanperubahan', $kamar->ID_DETIL_KAMAR], 'method'=> 'PATCH', 'role'=>'form'])  !!}
                                <form>
                                    <tr>
                                        <td width="50px">NAMA KAMAR</td>
                                        <td width="300px"><input class="form-control" name="namakamar" value="{{ $kamar->NAMA_KAMAR }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="50px">Jumlah Kamar</td>
                                        <td width="300px"><input type="number" class="form-control" name="jumlah" value="{{ $kamar->JUMLAH_KAMAR }}" required></td>
                                    </tr>
                                    <tr>
                                        <td width="200px" colspan="2">FASILITAS</td>
                                    </tr>
                                    <tr>
                                        <td width="300px" colspan="2"><textarea class="form-control" name="fasilitas" rows="5">{{ $kamar->FASILITAS }}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
                                            <a href="{{ route('tipekamar.tampil') }}" class="btn btn-danger"> Batal</a>
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