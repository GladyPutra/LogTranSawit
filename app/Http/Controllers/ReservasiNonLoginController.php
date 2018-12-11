<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Alert;
use DB;
use Carbon\Carbon;
use App\DataDiri;
use App\User;
use App\Kamar;
use App\Reservasi;
use App\DetilReservasi;
use App\Kota;
use App\Tarif;
define('page', 10);


class ReservasiNonLoginController extends Controller
{
    public function index()
    {
        $customer = DataDiri::where('username',Session::get('username'))->first();
        $kamar = Kamar::orderBy('ID_KAMAR')->where('STATUS_BOOKING', 'TERSEDIA')->get();
        $kota = Kota::orderBy('NAMA_KOTA')->get();
        $tarif = Tarif::orderBy('HARGA_TARIF', 'DESC')->get();

        $list = ['customer', 'kamar', 'kota', 'tarif'];
        return view('reservasinonlogin.reservasi', compact($list));
    }

    public function simpan_reservasi(Request $request)
    {
      $getID = Reservasi::orderBy(\DB::raw('substr(ID_BOOKING, 8)'),'DESC')->first();
      $ID = explode("-", $getID->ID_BOOKING);
      $kode = 'P' . Carbon::now()->format('dmy') . '-';
      $no = (int)$ID[1] + 1;

      if(strlen($no) == '1'){
        $id_booking = $kode . '00' . $no;
      }
      else if(strlen($no) == '2'){
        $id_booking = $kode . '0' . $no;
      }
      else{
        $id_booking = $kode . $no;
      }

      $id_data_diri = DB::table('data_diri')->insertGetId(array(
      		'NAMA' => $request->nama, 
        	'NO_IDENTITAS' => $request->no_identitas, 
        	'JENIS_KELAMIN' => $request->kelamin,
        	'NAMA_INSTITUSI' => $request->institusi, 
        	'NO_TELEPON' => $request->telp, 
        	'EMAIL' => $request->email, 
        	'ALAMAT' => $request->alamat)
	  );
      
      // if(){
	      $reservasi = new Reservasi();
	      $reservasi->ID_BOOKING = $id_booking;
	      $reservasi->TGL_RESERVASI = Carbon::now();
	      $reservasi->ID_KAMAR = $request->kamar;
	      $reservasi->ID_DATA_DIRI = $id_data_diri;
	      $reservasi->ID_KOTA = $request->kota;
	      $reservasi->ID_TARIF = $request->tarif;
        $reservasi->TGL_MENGINAP = $request->tgl_mulai;
        $reservasi->TGL_SELESAI = $request->tgl_selesai;
	      
	      if($reservasi->save()){
	        $detilreservasi = new DetilReservasi();
	        $detilreservasi->JENIS_TAMU = 'Personal';
	        $detilreservasi->JUMLAH_TAMU = $request->tamu_dewasa + $request->tamu_anak;
	        $detilreservasi->STATUS_BATAL = 'TIDAK';
	        $detilreservasi->JUMLAH_KAMAR = $request->jumlah_kamar;
	        $detilreservasi->JUMLAH_ANAK = $request->tamu_anak;
	        $detilreservasi->JUMLAH_DEWASA = $request->tamu_dewasa;
	        $detilreservasi->ID_BOOKING = $id_booking;
	        $detilreservasi->save();

	        $kamar = Kamar::FindOrFail($request->kamar);
	        $kamar->STATUS_BOOKING = 'TIDAK TERSEDIA';
	        $kamar->save();

          $harimulai = new DateTime($request->tgl_mulai);
          $hariselesai = new DateTime($request->tgl_selesai);
          $selisih = $harimulai->diff($hariselesai)->days;

          $tarif = Tarif::FindOrFail($request->tarif);

          $transaksi = new Transaksi();
          $transaksi->NO_INVOICE = $id_booking;
          $transaksi->ID_BOOKING = $id_booking;
          $transaksi->JUMLAH_TARIF = ($selisih * $request->jumlah_kamar * $kamar->tarifkamar['HARGA_KAMAR']) + $tarif->HARGA_TARIF;
          $transaksi->JENIS_STATUS = 'BELUM LUNAS';
          $transaksi->TGL_TRANSAKSI = Carbon::now();
          $transaksi->save();
	      }
	  // }

      Alert::success('Reservasi Ditambahkan dengan ID BOOKING = ' . $id_booking, 'SUKSES')->persistent('Close');
      return redirect()->route('home');
    }
}