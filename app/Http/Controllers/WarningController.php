<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WarningController extends Controller
{
    public function warningusername($username)
    {
    	if(\App\User::where('username',$username)->count() > 0)
    	{
    		return "gagal";
    	}
    	elseif(\App\User::where('username',$username)->count() == 0)
    	{
    		return "sukses";
    	}
    }
}
