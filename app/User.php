<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_user';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['username', 'password', 'nama', 'email', 'no_hp', 'id_role'];

    public function role(){
      return $this->belongsTo('App\Role','id_role','id_role');
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
}
