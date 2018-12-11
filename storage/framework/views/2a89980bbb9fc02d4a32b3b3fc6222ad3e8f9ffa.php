<?php foreach(\App\DistribusiPanen::all() as $dp): ?>
    <?php foreach(\App\KoordinatDistribusi::where('id_distribusi',$dp->id)->get() as $kd):?>
{lat: <?php echo e($kd->latitude); ?>, lng: <?php echo e($kd->longitude); ?>},
    <?php endforeach; ?>
<?php endforeach; ?>
