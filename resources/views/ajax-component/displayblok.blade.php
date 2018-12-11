<select class="form-control" name="blok">
  @foreach($blok as $blok)
    <option value="{{ $blok->id_blok }}">{{ $blok->deskripsi }}</option>
  @endforeach
</select>
