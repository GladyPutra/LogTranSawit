@extends('layouts.master')
@section('custom_css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endsection


@section('title')
	Kelola Shift
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
    @if(count($errors)>0)
    <ul>
        @foreach($errors->all() as $error)

            <li class="alert alert-danger">{{$error}}</li>

        @endforeach
    </ul>
    @endif
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
                  <div class="row">
                    <div class="col-md-2">
                      <button data-toggle='modal' data-target='#modaltambah' class="btn btn-md btn-success btn-block"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                  </div>
                  <div class="row" style="margin-top:20px">
                    <div class="col-md-12">
                      <table class="table table-striped table-bordered" id="tableshift">
                        <thead>
                          <tr>
                            <th style="display:none">id</th>
                            <th>Shift</th>
                            <th>Jam Awal</th>
                            <th>Jam Akhir</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach(\App\Shift::all() as $s)
                            <tr>
                              <td style="display:none">{{ $s->id }}</td>
                              <td>{{ $s->shift }}</td>
                              <td>{{ $s->jam_awal }}</td>
                              <td>{{ $s->jam_akhir }}</td>
                              <td>
                                <button data-toggle='modal' data-target='#modaledit' data-shift="{{ $s->shift }}" data-jawal="{{ $s->jam_awal }}" data-jakhir="{{ $s->jam_akhir }}" class="btn btn-sm btn-primary" onclick="clickedit(this)" value="{{ $s->id }}"><i class="fa fa-edit"></i> Ubah</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteshift(this,event)" value="{{ $s->id }}">Hapus</button>
                                <form method="post" class="formdelete_{{$s->id}}" action="{{ route('deleteshift',$s->id) }}">
                                  {{ csrf_field() }}
                                  {{ method_field('delete') }}
                                </form>
                              </td>
                            </tr>

                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    <!--End Advanced Tables -->
    </div>
</div>

<div id="modaltambah" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Shift </h4>
        <form method="post" action="{{ route('tambahshift') }}">
  				{{ csrf_field() }}
  	      <div class="modal-body">
  					<div class="col-md-4 form-group">
  						<label>Shift</label>
  						<input type="text" class="form-control" name="shift"/>
  					</div>
  					<div class="col-md-4 form-group">
  						<label>Jam Awal</label>
  						<input type="time" class="form-control" name="jam_awal"/>
  					</div>
  					<div class="col-md-4 form-group">
  						<label>Jam Akhir</label>
  						<input type="time" class="form-control" name="jam_akhir"/>
  					</div>
            <div class="col-md-4 form-group">
              <button type="submit" onclick="submittambah(event)" class="btn btn-md btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
  	      </div>
  			</form>
      </div>

      <div class="modal-footer">
				<div class="row">
				</div>
      </div>
    </div>
  </div>
</div>

<div id="modaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ubah Shift </h4>
        <form method="post" action="{{ route('editshift') }}">
  				{{ csrf_field() }}
          {{ method_field('PATCH') }}
  				<input type="hidden" class="form-control idshift" name="idshift"/>
          <div class="modal-body">
            <div class="col-md-4 form-group">
              <label>Shift</label>
              <input type="text" class="form-control txshift" name="shift"/>
            </div>
            <div class="col-md-4 form-group">
              <label>Jam Awal</label>
              <input type="text" class="form-control txjawal" name="jam_awal"/>
            </div>
            <div class="col-md-4 form-group">
              <label>Jam Akhir</label>
              <input type="text" class="form-control txjakhir" name="jam_akhir"/>
            </div>
            <div class="col-md-4 form-group">
              <button type="submit" onclick="submittambah(event)" class="btn btn-md btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </div>
  			</form>

      </div>
      <div class="modal-footer">
				<div class="row">
				</div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>

function deleteshift(t,e)
{
  var conf=confirm("apakah anda yakin ingin menghapus data ini ?");

  if(conf == true)
  {
    $(".formdelete_"+t.value).submit();
  }
  else {
    e.preventDefault();
  }
}

$(document).ready(function () {
    $('#tableshift').DataTable();
});
var id_shift;
function clickedit(t)
{
  $(".idshift").val(t.value);
  $(".txshift").val($(t).data('shift'));
  $(".txjawal").val($(t).data('jawal'));
  $(".txjakhir").val($(t).data('jakhir'));
}

function submittambah(e)
{
  var conf=confirm("apakah anda yakin ingin menambah data ini ?");

  if(conf == true)
  {

  }
  else {
    e.preventDefault();
  }
}
</script>
@endsection
