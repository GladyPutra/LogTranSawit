<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kapasitas extends Model
{
  protected $table = 'kapasitas';
  protected $primaryKey = 'id';
  public $timestamps = false;
  public $incrementing = false;
  protected $guarded = ['id'];
}
