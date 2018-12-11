<select class="form-control" name="tph">
  <?php $__currentLoopData = $tph; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($tph->id_tph); ?>"><?php echo e($tph->deskripsi); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
