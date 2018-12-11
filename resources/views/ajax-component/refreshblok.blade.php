<div class="form-group col-md-3">
							<label>Pilih Blok</label>
									<select class="form-control pilih-blok" name="blok">
										@foreach(\App\Blok::where('id_afdeling',$id)->get() as $af)
											<option value="{{ $af->id_blok }}">{{ $af->deskripsi }}</option>
										@endforeach
									</select>
							</div>
							<script>
							
							$.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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