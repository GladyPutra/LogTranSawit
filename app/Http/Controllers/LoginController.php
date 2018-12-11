<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Alert;
use App\User;
use App\Role;
use DB;
use Validator;


class LoginController extends Controller
{
    public function home()
    {
        return view('login');
    }

    // public function doLogin(Request $request)
    // {
    //     $username = $request->username;
    //     $password = $request->password;

    //   	$user = User::where('username', $username)->where('password',$password)->first();
    //   	if(!empty($user))
    //   	{
    //       Session::put('username',$username);
    //       Session::put('password',$password);
    //       Session::put('role',$user['id_role']);
    //       Session::put('login',TRUE);
    //       Alert::success('Selamat Datang, '. $username, 'LOGIN SUKSES')->persistent('Close');
    //       return redirect()->route('dashboard');
    //   	}
    //   	else
    //     {
    //   		Alert::error('Login Gagal' , 'WARNING')->persistent('Close');
    //       return redirect()->route('login.home');
    //     }

    // }

    public function doLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if(Auth::attempt(['username' => $username, 'password' => $password]))
        {
          if(\Auth::user()->id_role == 6)
          {
            // Alert::success('Selamat Datang, '. $username, 'LOGIN SUKSES')->persistent('Close');
            return redirect()->route('managerpabrikberanda');
          }
          else {
            // Alert::success('Selamat Datang, '. $username, 'LOGIN SUKSES')->persistent('Close');
            return redirect()->route('dashboard');
          }
        }
        else
        {
            Alert::error('Login Gagal' , 'WARNING')->persistent('Close');
            return redirect()->route('login.home');

        }
    }

    public function logout()
    {
        Session::flush();
        // Alert::success('Anda Telah Logout' , 'SUKSES')->persistent('Close');
        return redirect()->route('login.home');
    }

    public function register()
    {
      return view('registerCustomer');
    }

    public function daftar(Request $request)
    {
      $cekUser = User::where('USERNAME',$request->username)->get();
      // dd($cekUser);die();
      if($cekUser->count())
      {
        Alert::error('Username Sudah Digunakan', 'ERROR')->persistent('Close');
        return redirect()->route('login.register');
      }
      else
      {
        if($request->password == $request->konfirmasi)
        {
          $user = new User();
          $user->USERNAME = $request->username;
          $user->PASSWORD = bcrypt($request->password);
          $user->NAMA = $request->nama;
          $user->EMAIL = $request->email;
          $user->NO_HP = $request->no_hp;
          $user->ID_ROLE = $request->role;
          $user->save();

          Alert::success('Silahkan Login' , 'SUKSES')->persistent('Close');
          return redirect()->route('login.home');
        }
        else
        {
          Alert::error('Konfirmasi Password Tidak Sesuai', 'ERROR')->persistent('Close');
          return redirect()->route('login.register');
        }
      }
    }


    public function lupapassword()
    {
      return view('lupaPassword');
    }

    public function reset(Request $request)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 6; $i++) {
          $string .= $characters[mt_rand(0, $max)];
        }

        $user = User::where('USERNAME',$request->username)->first();
        if(!empty($user))
        {
          $user->PASSWORD = $string;
          $user->save();
          Alert::success('Password Baru Anda : ' . $string, 'SUKSES')->persistent('Close');
          return redirect()->route('login.home');
        }
        else
        {
          Alert::error('Username Tidak Ditemukan...', 'PERINGATAN')->persistent('Close');
          return redirect()->route('login.lupapassword');
        }
    }
}
