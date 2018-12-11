<table class="table table-striped table-bordered">

    <tr>
      <th rowspan="2">Afdeling</th>
      <th rowspan="2">Blok</th>
      <th colspan="31">Tgl</th>
    </tr>

    <tr>
      <?php for($i=1; $i<=31; $i++): ?>
        <td><?php echo e($i); ?></td>
      <?php endfor; ?>
    </tr>

    <tr>
      <td rowspan="<?php echo e(\App\Blok::where('id_afdeling',$afdeling->id_afdeling)->count()); ?>"><?php echo e($afdeling->deskripsi); ?></td>
      <?php if(\App\Blok::where('id_afdeling',$afdeling->id_afdeling)->pluck('deskripsi')->first()): ?>
        <td><?php echo e(\App\Blok::where('id_afdeling',$afdeling->id_afdeling)->pluck('deskripsi')->first()); ?></td>
        <?php for($i=1; $i<=31; $i++): ?>
          <?php if($i == 1): ?>
            <td>v</td>
          <?php else: ?>
            <td></td>
          <?php endif; ?>
        <?php endfor; ?>
      <?php endif; ?>
    </tr>

    <?php $i2 = 2; ?>
    <?php $__currentLoopData = \App\Blok::where('id_afdeling',$afdeling->id_afdeling)->where('id_blok','<>',\App\Blok::where('id_afdeling',$afdeling->id_afdeling)->min('id_blok'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($blok->deskripsi); ?></td>
      <?php for($i=1; $i<=31; $i++): ?>
        <?php if($i == $i2): ?>
          <td>v</td>
        <?php else: ?>
          <td></td>
        <?php endif; ?>
      <?php endfor; ?>
      <?php $i2++; ?>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- <tr>
      <td rowspan="<?php echo e(\App\Blok::where('id_afdeling',$afdeling->id_afdeling)->count()); ?>"></td>

    </tr> -->

</table>
