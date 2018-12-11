<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrukSopir extends Model
{
  protected $table = 'truk_sopir';
  protected $primaryKey = 'id';
  public $timestamps = false;
  public $incrementing = false;
  protected $guarded = ['id'];
}
