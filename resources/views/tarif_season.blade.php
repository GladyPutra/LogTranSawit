@extends('layouts.master')
@section('custom_css')
@endsection

@section('title')
	PENGELOLAAN TARIF DAN SEASON KAMAR
@endsection

@section('content')
<div class="col-lg-6">
	<div class="panel panel-default">
    	<div class="panel-heading">
        	Tarif Kamar
        </div>
        <div class="col-lg-6">
	        <form action="{{route('tarif.simpan')}}" method="post" role="form">
	        {{csrf_field()}}
	        <br>
	        	<div class="form-group">
	            	<input type="number"class="form-control" name="tarifbaru" placeholder="Masukkan Tarif Baru" 
	            	value="<?php if($dataTarif != null) echo $dataTarif->HARGA_TARIF; else ""; ?>" required>
	            	<input type="hidden" name="idTarif" value="<?php if($dataTarif != null) echo $dataTarif->ID_TARIF; else ""; ?>">
	            	<?php if($dataTarif != null) echo "Id Tarif : ".$dataTarif->ID_TARIF; else ""; ?>
	            </div>
    	</div>
    	<div class="col-lg-6">
	        <br>
	        	<div class="form-group">
	            	<button type="submit" class="btn btn-primary">Simpan</button>
	            	<a href="{{ route('tarifseason.tampil') }}" class="btn btn-danger">Batal</a>
	            </div>     		
        	</form>
    	</div>

        <div class="panel-body">
        	<div class="table-responsive">
                @if($tarif->count())
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>ID TARIF</th>
                            <th>HARGA TARIF</th>
                            <th>KONTROL</th>
                        </tr>
                        </thead>
                        @foreach($tarif as $data)
                        <tbody>
                        <tr>
                            <td class="center">{{ $data->ID_TARIF }}</td>
                            <td>Rp. {{number_format($data->HARGA_TARIF, 2, ',', '.')}}</td>
                            <td class="center">
                            	<form method="POST" action="{{ route('tarif.hapus', $data->ID_TARIF) }}" accept-charset="UTF-8">
		                        	<input name="_method" type="hidden" value="DELETE">
			                       	<input name="_token" type="hidden" value="{{ csrf_token() }}">
			                            <a href="{{ route('tarif.edit', $data->ID_TARIF) }}" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i> Ubah</a>
			                        <input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Yakin Ingin Menghapus Tarif?');" value="Hapus">
			                    </form>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                {!! $tarif->links() !!}
                @else
                <div class="alert">
                    <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
                </div>
                @endif
  		</div>
        <div class="panel-footer">
	        Panel Footer
        </div>
    </div>
</div>
<div class="col-lg-6">
	<div class="panel panel-default">
    	<div class="panel-heading">
        	Season Kamar
        </div>
        <div class="col-lg-6">
	        <form action="{{route('season.simpan')}}" method="post" role="form">
	        {{csrf_field()}}
	        <br>
	        	<div class="form-group">
	            	<input class="form-control" name="seasonbaru" placeholder="Masukkan Season Baru"
	            	value="<?php if($dataSeason != null) echo $dataSeason->NAMA_SEASON; else ""; ?>" required>
	            	<input type="hidden" name="idSeason" value="<?php if($dataSeason != null) echo $dataSeason->ID_SEASON; else ""; ?>">
	            	<?php if($dataSeason != null) echo "Id Season : ".$dataSeason->ID_SEASON; else ""; ?>	
	            </div>
    	</div>
    	<div class="col-lg-6">
	        <br>
	        	<div class="form-group">
	            	<button type="submit" class="btn btn-primary">Simpan</button>
	            	<a href="{{ route('tarifseason.tampil') }}" class="btn btn-danger">Batal</a>
	            </div>     		
        	</form>
    	</div>
    	<div class="panel-body">
        	<div class="table-responsive">
                @if($season->count())
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>ID SEASON</th>
                            <th>NAMA SEASON</th>
                            <th>KONTROL</th>
                        </tr>
                        </thead>
                        @foreach($season as $data)
                        <tbody>
                        <tr>
                            <td class="center">{{ $data->ID_SEASON }}</td>
                            <td>{{ $data->NAMA_SEASON }}</td>
                            <td>
                            	<form method="POST" action="{{ route('season.hapus', $data->ID_SEASON) }}" accept-charset="UTF-8">
		                        	<input name="_method" type="hidden" value="DELETE">
			                       	<input name="_token" type="hidden" value="{{ csrf_token() }}">
			                            <a href="{{ route('season.edit', $data->ID_SEASON) }}" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i> Ubah</a>
			                        <input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Yakin Ingin Menghapus Season?');" value="Hapus">
			                    </form>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                {!! $season->links() !!}
                @else
                <div class="alert">
                    <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
                </div>
                @endif
  		</div>
        <div class="panel-footer">
	        Panel Footer
        </div>
    </div>
</div>
@endsection

@section('custom_script')
@endsection