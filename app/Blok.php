<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
  protected $table = 'blok';
  protected $primaryKey = 'id_blok';
  public $timestamps = false;
  public $incrementing = false;
  protected $fillable = ['jumlah_pohon','luas','koordinat','deskripsi','id_afdeling'];
}
