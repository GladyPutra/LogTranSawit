<select class="form-control" name="blok">
  <?php $__currentLoopData = $blok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($blok->id_blok); ?>"><?php echo e($blok->deskripsi); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
