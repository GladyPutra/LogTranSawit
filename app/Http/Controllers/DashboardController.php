<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Alert;
use App\DataDiri;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
    	
            $user = User::where('username',\Auth::user()->username)->first();
            return view('beranda', compact('user'));
        
    }

    public function home(){
        return view('welcome');
    }
}
