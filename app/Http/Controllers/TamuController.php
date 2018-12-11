<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Alert;
use Carbon\Carbon;
use App\DataDiri;
use App\User;
define('page', 10);

class TamuController extends Controller
{

    public function index()
    {
    	$tamu = DataDiri::orderBy('ID_DATA_DIRI')->paginate(page);

    	$list = ['tamu'];
    	return view('tamu.index', compact($list));
    }

    public function pencarian(Request $request)
    {
    	$katakunci = $request->input('katakunci');
    	$tamu = DataDiri::orderBy('ID_DATA_DIRI')->where(function($q) use ($katakunci){
      	  $q->where('NAMA','LIKE',"%$katakunci%")
      	  	->orWhere('NAMA_INSTITUSI','LIKE',"%$katakunci%")
      	  	->orWhere('NO_IDENTITAS','LIKE',"%$katakunci%")
      	  	->orWhere('EMAIL','LIKE',"%$katakunci%")
      	  	->orWhereHas('user',function($r) use ($katakunci){
      		  	$r->where('tbl_user.USERNAME','LIKE',"%$katakunci%");
      		});
      	})->paginate(page);

      	$tamu->appends(['katakunci' => $katakunci]);

    	$list = ['tamu'];
    	return view('tamu.index', compact($list));
    }

    public function tambah()
    {
    	return view('tamu.tambah');
    }

    public function simpan(Request $request)
    {
    	$tamu = new DataDiri();
    	$tamu->NAMA = $request->nama;
    	$tamu->NO_IDENTITAS = $request->no_identitas;
    	$tamu->JENIS_KELAMIN = $request->kelamin;
    	$tamu->NAMA_INSTITUSI = $request->institusi;
    	$tamu->NO_TELEPON = $request->telp;
    	$tamu->EMAIL = $request->email;
    	$tamu->ALAMAT = $request->alamat;
    	$tamu->TGL_BUAT = Carbon::now();

    	if($request->kategori == "Personal")
    	{
    		$user = new User();
    		$user->USERNAME = $request->nama;
    		$user->PASSWORD = $request->no_identitas;
    		$user->ID_ROLE = 6;
    		$user->save();

    		$tamu->username = $user->username;
    	}
    	else
    		$tamu->username = "";

	    $tamu->save();
	    Alert::success('Tamu Baru Berhasil Disimpan' , 'SUKSES')->persistent('Close');
    	
    	return redirect()->route('tamu.tampil');
    }

    public function ubah($id)
    {
    	$tamu = DataDiri::FindorFail($id);
    	if($tamu->username == null)
    	{
    		Alert::error('Tidak Dapat Mengubah Tamu Grup' , 'PERINGATAN')->persistent('Close');
    		return redirect()->route('tamu.tampil');
    	}
    	else
    		return view('tamu.ubah', compact('tamu'));
    }

    public function simpanperubahan(Request $request, $id)
    {
    	$tamu = DataDiri::FindorFail($id);
    	$tamu->NAMA = $request->nama;
    	$tamu->NO_IDENTITAS = $request->no_identitas;
    	$tamu->JENIS_KELAMIN = $request->kelamin;
    	$tamu->NAMA_INSTITUSI = $request->institusi;
    	$tamu->NO_TELEPON = $request->telp;
    	$tamu->EMAIL = $request->email;
    	$tamu->ALAMAT = $request->alamat;
    	$tamu->save();
	    Alert::success('Tamu Baru Berhasil Diperbarui' , 'SUKSES')->persistent('Close');
    	
    	return redirect()->route('tamu.tampil');
    }

    public function detil($id)
    {
    	$tamu = DataDiri::FindorFail($id);
    	return view('tamu.detil', compact('tamu'));
    }


}
