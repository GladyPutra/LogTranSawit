<select class="form-control" name="id">
									  <?php $__currentLoopData = \App\TPH::where('id_blok',$id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									    <option value="<?php echo e($blok->id_tph); ?>"><?php echo e($blok->deskripsi); ?></option>
									  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>