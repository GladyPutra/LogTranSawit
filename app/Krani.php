<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Krani extends Model
{
  protected $table = 'krani';
  protected $primaryKey = 'id';
  public $timestamps = false;
  public $incrementing = false;
  protected $guarded = ['id'];
}
