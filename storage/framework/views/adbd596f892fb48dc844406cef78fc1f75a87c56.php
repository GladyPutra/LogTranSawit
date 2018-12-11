<?php $__env->startSection('custom_css'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
	Kelola Shift
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
    <?php if(count($errors)>0): ?>
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li class="alert alert-danger"><?php echo e($error); ?></li>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
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
                      <button data-toggle='modal' data-target='#modaltambah' class="btn btn-md btn-success btn-block"><i class="fa fa-plus"></i>Tambah</button>
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
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = \App\Shift::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td style="display:none"><?php echo e($s->id); ?></td>
                              <td><?php echo e($s->shift); ?></td>
                              <td><?php echo e($s->jam_awal); ?></td>
                              <td><?php echo e($s->jam_akhir); ?></td>
                              <td>
                                <button data-toggle='modal' data-target='#modaledit' data-shift="<?php echo e($s->shift); ?>" data-jawal="<?php echo e($s->jam_awal); ?>" data-jakhir="<?php echo e($s->jam_akhir); ?>" class="btn btn-sm btn-primary" onclick="clickedit(this)" value="<?php echo e($s->id); ?>"><i class="fa fa-edit"></i>Ubah</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteshift(this,event)" value="<?php echo e($s->id); ?>">Hapus</button>
                                <form method="post" class="formdelete_<?php echo e($s->id); ?>" action="<?php echo e(route('deleteshift',$s->id)); ?>">
                                  <?php echo e(csrf_field()); ?>

                                  <?php echo e(method_field('delete')); ?>

                                </form>
                              </td>
                            </tr>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <form method="post" action="<?php echo e(route('tambahshift')); ?>">
  				<?php echo e(csrf_field()); ?>

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
              <button type="submit" onclick="submittambah(event)" class="btn btn-md btn-success"><i class="fa fa-save"></i>Simpan</button>
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
        <h4 class="modal-title">Edit Shift </h4>
        <form method="post" action="<?php echo e(route('editshift')); ?>">
  				<?php echo e(csrf_field()); ?>

          <?php echo e(method_field('PATCH')); ?>

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
              <button type="submit" onclick="submittambah(event)" class="btn btn-md btn-success"><i class="fa fa-save"></i>Simpan</button>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>