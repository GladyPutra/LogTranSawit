<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPH extends Model
{
  protected $table = 'tph';
  protected $primaryKey = 'id_tph';
  public $timestamps = false;
  public $incrementing = false;
  protected $fillable = ['deskripsi','kapasitas','koordinat','id_blok','panen'];
}
