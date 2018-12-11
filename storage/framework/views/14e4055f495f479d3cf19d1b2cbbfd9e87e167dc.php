<div class="form-group col-md-3">
							<label>Pilih Blok</label>
									<select class="form-control pilih-blok" name="blok">
										<?php $__currentLoopData = \App\Blok::where('id_afdeling',$id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $af): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($af->id_blok); ?>"><?php echo e($af->deskripsi); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
							</div>
							<script>
							
							$.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                                }
                            });
							
						
							
						    $(".pilih-blok").change(function(){
   $.ajax({
      type: 'get',
      url: '../refreshtph/'+$(this).val(),
      success: function(data)
      {
          $("#displaytphlist").html(data);
      }
   }); 
});
							
						
							</script>