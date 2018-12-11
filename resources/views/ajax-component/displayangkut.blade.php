<table class="table table-striped table-bordered">

    <tr>
      <th rowspan="2">Afdeling</th>
      <th rowspan="2">Blok</th>
      <th colspan="31">Tgl</th>
    </tr>

    <tr>
      @for($i=1; $i<=31; $i++)
        <td>{{ $i }}</td>
      @endfor
    </tr>

    <tr>
      <td rowspan="{{ \App\Blok::where('id_afdeling',$afdeling->id_afdeling)->count() }}">{{ $afdeling->deskripsi }}</td>
      @if(\App\Blok::where('id_afdeling',$afdeling->id_afdeling)->pluck('deskripsi')->first())
        <td>{{ \App\Blok::where('id_afdeling',$afdeling->id_afdeling)->pluck('deskripsi')->first() }}</td>
        @for($i=1; $i<=31; $i++)
          @if($i == 1)
            <td>v</td>
          @else
            <td></td>
          @endif
        @endfor
      @endif
    </tr>

    <?php $i2 = 2; ?>
    @foreach(\App\Blok::where('id_afdeling',$afdeling->id_afdeling)->where('id_blok','<>',\App\Blok::where('id_afdeling',$afdeling->id_afdeling)->min('id_blok'))->get() as $blok)
    <tr>
      <td>{{ $blok->deskripsi }}</td>
      @for($i=1; $i<=31; $i++)
        @if($i == $i2)
          <td>v</td>
        @else
          <td></td>
        @endif
      @endfor
      <?php $i2++; ?>
    </tr>
    @endforeach

    <!-- <tr>
      <td rowspan="{{ \App\Blok::where('id_afdeling',$afdeling->id_afdeling)->count() }}"></td>

    </tr> -->

</table>
