<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afdeling extends Model
{
    protected $table = 'afdeling';
    protected $primaryKey = 'id_afdeling';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['jumlah_pohon','luas','koordinat','deskripsi','id_user','id_kebun','warna'];
    
}
