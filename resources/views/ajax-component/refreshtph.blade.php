<select class="form-control" name="id">
									  @foreach(\App\TPH::where('id_blok',$id)->get() as $blok)
									    <option value="{{ $blok->id_tph }}">{{ $blok->deskripsi }}</option>
									  @endforeach
									</select>