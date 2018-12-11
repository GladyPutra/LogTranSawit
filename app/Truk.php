<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truk extends Model
{
  protected $table = 'truk';
  protected $primaryKey = 'id_truk';
  public $timestamps = false;
  public $incrementing = false;
  protected $guarded = ['id_truk'];
}
