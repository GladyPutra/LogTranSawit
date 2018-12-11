
<?php $__env->startSection('custom_css'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
	Tampil Panen/Angkut
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
                    <div class="form-group col-md-2">
                      <label>Afdeling : </label>
                      <select class="form-control selafdeling">
                        <option value="0">--Pilih--</option>
                        <?php $__currentLoopData = \App\Afdeling::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $afd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($afd->id_afdeling); ?>"><?php echo e($afd->deskripsi); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="row" style="margin-top:20px">
                    <div class="col-md-12 tableangkut">

                    </div>
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
$.ajaxSetup({
  header : {
    'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>'
  }
});

$(".selafdeling").change(function(){
  $(".tableangkut").html("<h3>Silahkan Tunggu..</h3>");
  if($(this).val() == 0){
      $(".tableangkut").html("");
  }
  else {
    $.ajax({
      url: '../managerpabrik/displayangkutajax/'+ $('.selafdeling').val(),
      type: 'get',
      success : function(data){
        $(".tableangkut").html(data);
      }
    });
  }

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>