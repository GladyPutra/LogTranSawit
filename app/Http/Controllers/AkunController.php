<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use App\Kota;
use Alert;

class AkunController extends Controller
{
    public function index()
    {
    	$user = User::orderBy('ID_USER')->paginate(10);
    	$role = Role::orderBy('ID_ROLE')->get();
    	$dataUser = null;

    	$list = ['user', 'role', 'dataUser'];
    	return view('akunpengguna.index', compact($list));
    }

    public function simpan(Request $request)
    {
        $this->validate($request,[
            'username'=>'required|unique:users,username',
            'password'=>'required',
            'nama'=>'required',
            'email'=>'required|email',
            'no_hp'=>'required|min:10|max:15'
            ]);

	    	$user = new User();
	    	$user->USERNAME = $request->username;
	    	$user->PASSWORD = bcrypt($request->password);
            $user->NAMA = $request->nama;
            $user->EMAIL = $request->email;
            $user->no_hp = $request->no_hp;
	    	$user->ID_ROLE = $request->role;
	    	$user->save();
	    	Alert::success('Pegawai Baru Berhasil Disimpan' , 'SUKSES')->persistent('Close');
	    
	    // dd($user);
    	// return $this->index();
    	return redirect()->route('pegawai.tampil');
    }

    public function doedit(Request $request,$id)
    {
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
            'nama'=>'required',
            'email'=>'required|email',
            'no_hp'=>'required|min:10|max:15'
            ]);
               
        $user = User::FindOrFail($id);
            $user->USERNAME = $request->username;
            $user->PASSWORD = bcrypt($request->password);
            $user->NAMA = $request->nama;
            $user->EMAIL = $request->email;
            $user->no_hp = $request->no_hp;
            $user->ID_ROLE = $request->role;
            $user->save();
            Alert::success('Pegawai Berhasil Diperbarui' , 'SUKSES')->persistent('Close');

            return redirect()->route('pegawai.tampil');
    }



    public function pencarian(Request $request)
    {
    	$katakunci = $request->input('katakunci');
      	$user = User::orderBy('username')->where(function($q) use ($katakunci){
      	  $q->where('nama','LIKE',"%$katakunci%")
      		->orWhereHas('role',function($r) use ($katakunci){
      		  	$r->where('role.deskripsi','LIKE',"%$katakunci%");
      		})
            ->orwhere('email','LIKE',"%$katakunci%")
            ->orwhere('no_hp','LIKE',"%$katakunci%");
      	})->paginate(10);
      	$user->appends(['katakunci' => $katakunci]);

      	$role = Role::orderBy('ID_ROLE')->whereNotIn('ID_ROLE',[6])->get();
    	$dataUser = null;

    	$list = ['user', 'role', 'dataUser'];
    	return view('akunpengguna.index', compact($list));
    }

    public function ubah($id)
    {
    	$user = User::orderBy('ID_USER')->paginate(10);
    	$role = Role::orderBy('ID_ROLE')->get();
    	$dataUser = User::FindOrFail($id);
        $flag = 1;
        \Log::info($dataUser);

    	$list = ['user', 'role', 'dataUser'];
    	return view('akunpengguna.index', compact($list,'flag'));
    }

    public function hapus($id)
    {
    	$user = User::FindOrFail($id);
    	$user->delete();
    	Alert::success('Pegawai Berhasil Dihapus' , 'SUKSES')->persistent('Close');
    	return redirect()->route('pegawai.tampil');
    }

    public function resetpassword($id)
    {
    	$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$string = '';
		$max = strlen($characters) - 1;
		for ($i = 0; $i < 6; $i++) {
			$string .= $characters[mt_rand(0, $max)];
		}
		$user = User::FindOrFail($id);
		$user->PASSWORD = bcrypt($string);
		$user->save();
		Alert::success('Password Baru Pegawai : ' . $string, 'SUKSES')->persistent('Close');

    	return redirect()->route('pegawai.tampil');
    }


    public function indexCustomer()
    {
        $user = User::orderBy('nama')->paginate(10);
        return view('customer.index', compact('user'));
    }
}
