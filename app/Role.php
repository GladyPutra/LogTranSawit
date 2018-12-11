<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id_role';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['deskripsi'];
}
