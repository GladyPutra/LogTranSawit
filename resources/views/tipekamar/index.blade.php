@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	PENGELOLAAN TIPE KAMAR
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
                    <a href="{{ route('tipekamar.tambah') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                    <a href="{{ route('tipekamar.tampil') }}" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>
                    
                </div>
                {!! Form::open(['method'=>'GET','route'=>'tipekamar.cari'])  !!}
                <div class="col-sm-4 col-xs-8 form-group pull-right input-group">
                    <input type="text" name="katakunci" class="form-control" placeholder="Pencarian...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                @if($kamar->count())
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAMA KAMAR</th>
                            <th>JML KAMAR</th>
                            <th>FASILITAS</th>
                            <th>KONTROL</th>
                        </tr>
                        </thead>
                        @foreach($kamar as $data)
                        <tbody>
                        <tr>
                            <td class="center">{{ $data->ID_DETIL_KAMAR }}</td>
                            <td>{{ $data->NAMA_KAMAR }}</td>
                            <td>{{ $data->JUMLAH_KAMAR }}</td>
                            <td>{{ $data->FASILITAS }}</td>
                            <td width="130px">
                                <form method="POST" action="{{ route('tipekamar.hapus', $data->ID_DETIL_KAMAR) }}" accept-charset="UTF-8">
                                  <input name="_method" type="hidden" value="DELETE">
                                  <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <a href="{{ route('tipekamar.ubah', $data->ID_DETIL_KAMAR) }}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Ubah</a>
                                    <input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Ingin Menghapus Tipe Kamar?');" value="Hapus">
                                </form>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                {!! $kamar->links() !!}
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