<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taksasi extends Model
{
  protected $table = 'taksasi';
  protected $primaryKey = 'id_taksasi';
  public $timestamps = false;
  public $incrementing = false;
  protected $guarded = ['id_taksasi'];
}
