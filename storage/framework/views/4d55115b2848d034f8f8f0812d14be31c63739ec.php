
<?php $__env->startSection('custom_css'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
Histori Distribusi
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
              <form method="post" action="">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                  <label>Pilih Tanggal</label>
                  <input type="date" class="form-control tanggal" name="tanggal" required>
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-primary btn-md btn-lihat">Lihat Histori</button>
                </div>
              </form>

            </div>
          </div>
          <div class="row" style="margin-top:20px">

          </div>
        </div>
      </div>
    </div>
    <!--End Advanced Tables -->
  </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>


$(".btn-lihat").click(function(){
  window.location.href = "../../managerpabrik/historidistribusi/tampil/"+$(".tanggal").val().replace(/\//g,'-');
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>