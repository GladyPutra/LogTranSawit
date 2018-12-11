<select class="form-control" name="tph">
  @foreach($tph as $tph)
    <option value="{{ $tph->id_tph }}">{{ $tph->deskripsi }}</option>
  @endforeach
</select>
