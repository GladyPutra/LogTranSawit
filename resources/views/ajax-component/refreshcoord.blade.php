<?php foreach(\App\DistribusiPanen::all() as $dp): ?>
    <?php foreach(\App\KoordinatDistribusi::where('id_distribusi',$dp->id)->get() as $kd):?>
{lat: {{ $kd->latitude }}, lng: {{ $kd->longitude }}},
    <?php endforeach; ?>
<?php endforeach; ?>
