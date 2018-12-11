<?php $__env->startSection('custom_css'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
	Kelola Shift
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
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
                      <div class="btn btn-md btn-success btn-block"><?php echo e(date('d-m-Y')); ?></div>
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
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = \App\Kapasitas::where('tgl',date('Y-m-d'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($kp->tgl); ?></td>
                              <td><?php echo e($kp->shift); ?></td>
                              <td><?php echo e($kp->kapasitas); ?></td>
                              <td>
                                <button data-toggle='modal' data-target='#modaledit' class="btn btn-sm btn-primary" onclick="clickedit(this)" data-shift="<?php echo e($kp->shift); ?>" value="<?php echo e($kp->id); ?>">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deletekapasitas(this,event)" value="<?php echo e($kp->id); ?>">Delete</button>
                                <form class="formdelete_<?php echo e($kp->id); ?>" method="post" action="<?php echo e(route('deletekapasitas',$kp->id)); ?>">
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

<div id="modaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title-z"></h4>
        <form method="post" action="<?php echo e(route('editkapasitas')); ?>">
  				<?php echo e(csrf_field()); ?>

          <?php echo e(method_field('PATCH')); ?>

  				<input type="hidden" class="form-control idkapasitas" name="idkapasitas"/>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Masukkan Kapasitas</label>
                <input type="text" class="form-control" name="kapasitas"/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 form-group">
                <button type="submit" onclick="submittambah(event)" class="btn btn-md btn-success">Submit</button>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>
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
  $(".title-z").text("Edit Kepasitas Shift "+$(t).data('shift'));
  $(".idkapasitas").val(t.value);
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>