@extends('layouts.master')
@section('custom_css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endsection


@section('title')
	Kelola Kapasitas
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
                      <div class="btn btn-md btn-success btn-block">{{ date('d-m-Y') }}</div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:20px">
                    <div class="col-md-12">
                      <table class="table table-striped table-bordered" id="tableshift">
                        <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach(\App\Kapasitas::where('tgl',date('Y-m-d'))->get() as $kp)
                            <tr>
                              <td>{{ $kp->tgl }}</td>
                              <td>{{ $kp->shift }}</td>
                              <td>{{ number_format( $kp->kapasitas, 0 , '.' , ',' ) }}</td>
                              <td>
                                <button data-toggle='modal' data-target='#modaledit' class="btn btn-sm btn-primary" onclick="clickedit(this)" data-shift="{{ $kp->shift }}" value="{{ $kp->id }}"><i class="fa fa-edit"></i> Ubah</button>
                                <button class="btn btn-sm btn-danger" onclick="deletekapasitas(this,event)" value="{{ $kp->id }}">Hapus</button>
                                <form class="formdelete_{{ $kp->id }}" method="post" action="{{ route('deletekapasitas',$kp->id) }}">
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

<div id="modaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title-z"></h4>
        <form method="post" action="{{ route('editkapasitas') }}">
  				{{ csrf_field() }}
          {{ method_field('PATCH') }}
  				<input type="hidden" class="form-control idkapasitas" name="idkapasitas"/>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Masukkan Kapasitas</label>
                <input type="number" class="form-control" name="kapasitas"/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 form-group">
                <button type="submit" onclick="submittambah(event)" class="btn btn-md btn-success"><i class="fa fa-save"></i> Simpan</button>
              </div>
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

function deletekapasitas(t,e)
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
  $(".title-z").text("Ubah Kapasitas Shift "+$(t).data('shift'));
  $(".idkapasitas").val(t.value);
}

</script>
@endsection
