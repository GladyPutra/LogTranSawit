@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	PENGELOLAAN KAMAR
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
                @if(Session::get('role') == 1)
                    <a href="{{ route('kamar.tambah') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                @endif
                    <a href="{{ route('kamar.tampil') }}" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>
                    
                </div>
                {!! Form::open(['method'=>'GET','url'=>'/pengelolaan-kamar/cari'])  !!}
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
                            <th>ID KAMAR</th>
                            <th>NAMA KAMAR</th>
                            <th>TEMPAT TIDUR</th>
                            <th>JUMLAH</th>
                            <th>SMOKING</th>
                            <th>BOOKING</th>
                            <th>HARGA</th>
                            <th>KONTROL</th>
                        </tr>
                        </thead>
                        @foreach($kamar as $data)
                        <tbody>
                        <tr>
                            <td class="center">{{ $data->ID_KAMAR }}</td>
                            <td>{{ $data->detilkamar['NAMA_KAMAR'] }}</td>
                            <td>{{ $data->TEMPAT_TIDUR }}</td>
                            <td>{{ $data->detilkamar['JUMLAH_KAMAR'] }}</td>
                            <td class="center">{{ $data->STAUS_SMOKING }}</td>
                            <td class="center">{{ $data->STATUS_BOOKING }}</td>
                            <td>Rp. {{number_format($data->tarifkamar['HARGA_KAMAR'], 2, ',', '.')}}</td>
                            <td>
                                <a href="{{ route('kamar.detil',$data->ID_KAMAR) }}" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i> Detil</a>
                                @if(Session::get('role') == 1)
                                    <a href="{{ route('kamar.ubah',$data->ID_KAMAR) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Ubah</a>
                                @endif
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