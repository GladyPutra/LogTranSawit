@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	PENGELOLAAN TAMU
@endsection

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
        <!--  -->
        </div>
        <div class="col-lg-6">
            
        </div>

        <div class="panel-body">
                <div class="col-sm-4 col-xs-8 form-group">
                    <a href="{{ route('tamu.baru') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                    <a href="{{ route('tamu.tampil') }}" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>
                    
                </div>
                {!! Form::open(['method'=>'GET','url'=>'/tamu/cari'])  !!}
                <div class="col-sm-4 col-xs-8 form-group pull-right input-group">
                    <input type="text" name="katakunci" class="form-control" placeholder="Pencarian...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                @if($tamu->count())
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
                        @foreach($tamu as $data)
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
                               <a href="{{ route('tamu.ubah', $data->ID_DATA_DIRI) }}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Ubah</a>
                               <a href="{{ route('tamu.detil', $data->ID_DATA_DIRI) }}" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i> Detil</a>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                {!! $tamu->links() !!}
                @else
                <div class="alert table-responsive">
                    <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
                </div>
                @endif
            </div>
        <div class="panel-footer">
    <!--  -->
        </div>
    </div>
</div>
@endsection

@section('custom_script')
@endsection