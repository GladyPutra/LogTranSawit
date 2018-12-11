<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Alert;
use DB;
use DateTime;
use Carbon\Carbon;
use App\DataDiri;
use App\User;
use App\Kamar;
use App\Reservasi;
use App\DetilReservasi;
use App\Kota;
use App\Tarif;
use App\DetilTarif;
use App\Transaksi;
use App\CheckInOut;
use PDF;
define('page', 10);

class CustomerController extends Controller
{
    public function ubah($id)
    {
        $profil = DataDiri::FindOrFail($id);
    	return view('customer.edit', compact('profil'));
    }

    public function simpanPerubahan(Request $request, $id)
    {
        $profil = DataDiri::FindOrFail($id);
        $profil->NAMA = $request->nama;
        $profil->NO_IDENTITAS = $request->no_identitas;
        $profil->JENIS_KELAMIN = $request->kelamin;
        $profil->NAMA_INSTITUSI = $request->institusi;
        $profil->NO_TELEPON = $request->telp;
        $profil->EMAIL = $request->email;
        $profil->ALAMAT = $request->alamat;
        $profil->save();

        $user = User::FindOrFail($profil->username);
        $user->USERNAME = $request->username;
        $user->save();
        Session::put('username',$request->username);

        Alert::success('Perubahan Disimpan', 'SUKSES')->persistent('Close');
        return redirect()->route('dashboard');
    }

    public function gantipassword(Request $request, $id)
    {
        $profil = DataDiri::FindOrFail($id);
        $user = User::FindOrFail($profil->username);

        if($request->passwordlama == $user->PASSWORD)
        {
            if($request->passwordbaru == $request->konfirmasi)
            {
                $user->PASSWORD = $request->passwordbaru;
                $user->save();
                Alert::success('Password Berhasil Diganti', 'SUKSES')->persistent('Close');
                return redirect()->route('dashboard', compact('reservasi'));
            }
            else
                Alert::error('Konfirmasi Password Tidak Sesuai', 'PERINGATAN')->persistent('Close');
        }
        else
            Alert::error('Password Lama Tidak Sesuai', 'WARNING')->persistent('Close');

        return redirect()->route('customer.ubah', ['id' => $profil->ID_DATA_DIRI]);

    }

    public function simpan(Request $request)
    {
        $profil = new DataDiri();
        $profil->NAMA = $request->nama;
        $profil->NO_IDENTITAS = $request->no_identitas;
        $profil->JENIS_KELAMIN = $request->kelamin;
        $profil->NAMA_INSTITUSI = $request->institusi;
        $profil->NO_TELEPON = $request->telp;
        $profil->EMAIL = $request->email;
        $profil->ALAMAT = $request->alamat;
        $profil->username = Session::get('username');
        $profil->save();

        Alert::success('Data Diri Berhasil Disimpan', 'SUKSES')->persistent('Close');
        return redirect()->route('dashboard');
    }


    // DATA RESERVASI
    public function tambahreservasi()
    {
        $customer = DataDiri::where('username',Session::get('username'))->first();
        $kamar = Kamar::orderBy('ID_KAMAR')->where('STATUS_BOOKING', 'TERSEDIA')->get();
        $kota = Kota::orderBy('NAMA_KOTA')->get();
        $tarif = Tarif::orderBy('HARGA_TARIF', 'DESC')->get();

        $list = ['customer', 'kamar', 'kota', 'tarif'];
        return view('customer.tambahreservasi', compact($list));
    }

    public function datareservasi()
    {
        $user = DataDiri::where('username',Session::get('username'))->first();
        $reservasi = DetilReservasi::orderBy(\DB::raw('substr(ID_BOOKING, 8)'),'DESC')->where('STATUS_BATAL','TIDAK')
        ->WhereHas('reservasi', function($q) use ($user){
            $q->where('reservasi.ID_DATA_DIRI',$user->ID_DATA_DIRI);
        })->paginate(page);
        return view('customer.datareservasi', compact('reservasi'));
    }

    public function detilreservasi($id)
    {
        $reservasi = DetilReservasi::FindOrFail($id);
        return view('customer.detilreservasi', compact('reservasi'));
    }

    public function batalreservasi($id)
    {
        $reservasi = DetilReservasi::FindOrFail($id);
        if($reservasi->STATUS_BATAL == 'YA'){
            Alert::error('Reservasi Sudah Dibatalkan', 'PERINGATAN')->persistent('Close');
        }
        else{
            $reservasi->STATUS_BATAL = 'YA';
            $reservasi->save();

            $datareservasi = Reservasi::FindOrFail($reservasi->ID_BOOKING);
            $kamar = Kamar::FindOrFail($datareservasi->ID_KAMAR);
            $kamar->STATUS_BOOKING = 'TERSEDIA';
            $kamar->save();
            Alert::success('Reservasi Dibatalkan', 'SUKSES')->persistent('Close');
        }
        return redirect()->route('customer.datareservasi', compact('reservasi'));
    }

    public function historireservasi()
    {
        $user = DataDiri::where('username',Session::get('username'))->first();
        $reservasi = DetilReservasi::orderBy(\DB::raw('substr(ID_BOOKING, 8)'),'DESC')->whereNotIn('STATUS_BATAL',['TIDAK'])
        ->WhereHas('reservasi', function($q) use ($user){
            $q->where('reservasi.ID_DATA_DIRI',$user->ID_DATA_DIRI)
              ->where('reservasi.IS_DELETED','TIDAK');
        })->paginate(page);
        return view('customer.historireservasi', compact('reservasi'));
    }

    public function simpan_perubahan_reservasi(Request $request)
    {
      $reservasi = Reservasi::FindOrFail($request->id_booking);
      $reservasi->TGL_MENGINAP = $request->tgl_mulai;
      $reservasi->TGL_SELESAI = $request->tgl_selesai;
      $reservasi->save();

      $harimulai = new DateTime($request->tgl_mulai);
      $hariselesai = new DateTime($request->tgl_selesai);
      $selisih = $harimulai->diff($hariselesai)->days;

      $kamar = Kamar::FindOrFail($reservasi->ID_KAMAR);
      $tarif = Tarif::FindOrFail($reservasi->ID_TARIF);
      
      if($reservasi->save())
      {
        $transaksi = Transaksi::FindOrFail($request->id_booking);
        $transaksi->JUMLAH_TARIF = ($selisih * $reservasi->detilreservasi['JUMLAH_KAMAR'] * $kamar->tarifkamar['HARGA_KAMAR']) + $tarif->HARGA_TARIF;
        $transaksi->save();
      }

      Alert::success('Tanggal Pemesanan Diperbarui', 'SUKSES')->persistent('Close');
      return redirect()->route('customer.datareservasi');
    }
    


    //KAMAR
    public function kamar()
    {
        $kamar = Kamar::orderBy('ID_DETIL_KAMAR')->paginate(page);
        return view('customer.kamar', compact('kamar'));
    }

    public function pencarian(Request $request)  // Mencari Kamar
    {
      //Search Berdasarkan
      $katakunci = $request->input('katakunci');
      $kamar = Kamar::orderBy('ID_DETIL_KAMAR')->where(function($q) use ($katakunci){
          $q->where('ID_KAMAR','LIKE',"%$katakunci%")
            ->orWhere('TEMPAT_TIDUR','LIKE',"%$katakunci%")
            ->orWhere('STAUS_SMOKING','LIKE',"$katakunci%")
            ->orWhere('STATUS_BOOKING','LIKE',"%$katakunci%")
            ->orWhereHas('detilkamar',function($r) use ($katakunci){
                $r->where('detil_kamar.NAMA_KAMAR','LIKE',"%$katakunci%");

            });
      })->paginate(10);
      $kamar->appends(['katakunci' => $katakunci]);
      return view('customer.kamar', compact('kamar'));
    }

    public function detilkamar($id)
    {
      // $kamar = $id;
      $kamar = Kamar::Find($id);
      // $kamar = Kamar::where('ID_KAMAR','LIKE',"$id%")->first();
      return view('customer.detilkamar', compact('kamar'));
    }

    public function hapushistorireservasi($idbooking)
    {
        $reservasi = Reservasi::FindOrFail($idbooking);
        $reservasi->IS_DELETED = 'YA';
        $reservasi->save();

        Alert::success('Histori Reservasi Dihapus', 'SUKSES')->persistent('Close');
        return redirect()->route('customer.historireservasi');
    }

    public function tambahReservasiNotLogin()
    {
        $customer = DataDiri::where('username',Session::get('username'))->first();
        $kamar = Kamar::orderBy('ID_KAMAR')->where('STATUS_BOOKING', 'TERSEDIA')->get();
        $kota = Kota::orderBy('NAMA_KOTA')->get();
        $tarif = Tarif::orderBy('HARGA_TARIF', 'DESC')->get();

        $list = ['customer', 'kamar', 'kota', 'tarif'];
        return view('customer.tambahReservasiNotLogin', compact($list));
    }

    public function cetaknota($idbooking)
    {
      $reservasi = Reservasi::FindOrFail($idbooking);
      $kamar = Kamar::where('ID_KAMAR', $reservasi->ID_KAMAR)->get();
      $ekstraitem = DetilTarif::where('ID_TARIF', $reservasi->ID_TARIF)->get();
      $list = ['reservasi', 'kamar', 'ekstraitem'];
      //dd($reservasi->ekstraitem);
      return view('customer.cetaknota', compact($list));
    }

    public function export_cetaknota($idbooking)
    {
      $reservasi = Reservasi::FindOrFail($idbooking);
      $kamar = Kamar::where('ID_KAMAR', $reservasi->ID_KAMAR)->get();
      
      $namefile = 'Nota Pemesanan _ ' . $idbooking;
      $pdf = PDF::loadView('customer.exportnota', compact('reservasi', 'kamar'));
      $pdf->setPaper('A4', 'potrait');
      return $pdf->stream($namefile . '.pdf');
    }


    public function print($keterangan)
    {
        $pesan = '';
        if($keterangan == 'UnduhReservasi')
            $pesan = 'Tanda Terima Reservasi Berhasil Diunduh.';
        else if($keterangan == 'PrintReservasi')
            $pesan = 'Tanda Terima Reservasi Sedang Diproses.';

        Alert::success($pesan, 'SUKSES')->persistent('Close');
        return redirect()->back();
    }
}
