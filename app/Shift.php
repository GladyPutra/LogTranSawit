<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
  protected $table = 'shift';
  protected $primaryKey = 'id';
  public $timestamps = false;
  public $incrementing = false;
  protected $guarded = ['id'];
}
