<?php $__env->startSection('custom_css'); ?>
<style>
.row {
     position: relative;
 }

 .tgl {
   position: absolute;
   bottom: 0;
   right: 0;
 }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	BERANDA
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
                    <div class="col-md-2" style="background:rgba(102, 153, 153, 0.3); text-align:center">
                      <div class="row">
                        <div class="col-md-12">
                          <p style="font-size:30px;margin-top:20px">Kapasitas Saat Ini :</p>
                          <hr style="color:#000;width:100%"/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <p><strong style="font-size:50px;"><?php echo e(\App\Kapasitas::where('tgl',date('Y-m-d'))->sum('kapasitas')); ?></strong><strong> ton/jam</strong></p>
                        </div>
                      </div>
                    </div>
                    <div class="tgl col-md-4">
                      <h1><?php echo e(date('d-m-Y')); ?></h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="margin-top:20px">
                      <canvas id="myChart" width="400" height="90"></canvas>
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
<script src="<?php echo e(asset('bower_components/chart.js/dist/Chart.js')); ?>"></script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['<?php echo e(date("d-m-Y", strtotime("-4 day"))); ?>','<?php echo e(date("d-m-Y", strtotime("-3 day"))); ?>','<?php echo e(date("d-m-Y", strtotime("-2 day"))); ?>','<?php echo e(date("d-m-Y", strtotime("-1 day"))); ?>','<?php echo e(date("d-m-Y")); ?>'],
        datasets: [{
            label: "Kapasitas",
            data: ['<?php echo e($sum4); ?>', '<?php echo e($sum3); ?>', '<?php echo e($sum2); ?>', '<?php echo e($sum1); ?>', '<?php echo e($sum5); ?>'],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        legend: {
        	display: false
        }
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>