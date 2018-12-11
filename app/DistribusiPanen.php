<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistribusiPanen extends Model
{
  protected $table="distribusi_panen";
  protected $primaryKey ="id";
  public $timestamp = false;
  protected $guarded=['id'];
}
