<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Alert;
use DB;
use App\Kamar;
use App\TarifSeason;
use App\Tarif;
use App\DetilKamar;
define('page', 10);

class KamarController extends Controller
{
    public function index()
    {
    	$kamar = Kamar::orderBy('ID_DETIL_KAMAR')->paginate(page);
    	return view('kamar.index', compact('kamar'));
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
      return view('kamar.index', compact('kamar'));
    }

    public function detilkamar($id)
    {
      // $kamar = $id;
      $kamar = Kamar::Find($id);
      // $kamar = Kamar::where('ID_KAMAR','LIKE',"$id%")->first();
      return view('kamar.detil', compact('kamar'));
    }

    public function tambah()
    {
      $tipekamar = DetilKamar::all();
      $tarif = TarifSeason::all();
      return view('kamar.tambah', compact('tipekamar','tarif'));
    }

    public function simpankamar(Request $request)
    {
      $getID = Kamar::orderBy(\DB::raw('substr(ID_KAMAR, 0,4)'),'DESC')->first();
      $getTipe = DetilKamar::FindorFail($request->tipekamar);
      // echo substr($getID->ID_KAMAR,0,4);
      $kode = explode(" ", $getTipe->NAMA_KAMAR);
      $kode2 = "";

      $no = substr($getID->ID_KAMAR,0,4) + 1;
      for($i = 0; $i<count($kode); $i++)
      {
        $kode2 = $kode2 . substr($kode[$i], 0, 1);
      }

      $kamar = new Kamar();
      $kamar->ID_KAMAR= $no . $kode2;
      $kamar->TEMPAT_TIDUR = $request->tempat_tidur;
      if($request->smoking == "IYA")
        $kamar->STAUS_SMOKING = $request->smoking;
      else
        $kamar->STAUS_SMOKING = "TIDAK";

      $kamar->STATUS_BOOKING = "TERSEDIA";
      $kamar->ID_DETIL_KAMAR = $request->tipekamar;
      $kamar->ID_TARIF_SEASON = $request->tarifseason;
      $kamar->save();

      Alert::success('Kamar Ditambahkan', 'SUKSES')->persistent('Close');
      return redirect()->route('kamar.tampil');
    }

    public function ubah($id)
    {
      $kamar = Kamar::FindorFail($id);
      $tipekamar = DetilKamar::all();
      $tarif = TarifSeason::all();
      return view('kamar.ubah', compact('kamar','tipekamar','tarif'));
    }

    public function simpanperubahan(Request $request, $id)
    {
      $kamar = Kamar::FindorFail($id);
      $kamar->TEMPAT_TIDUR = $request->tempat_tidur;
      if($request->smoking == "IYA")
        $kamar->STAUS_SMOKING = $request->smoking;
      else
        $kamar->STAUS_SMOKING = "TIDAK";

      $kamar->STATUS_BOOKING = $request->booking;;
      $kamar->ID_DETIL_KAMAR = $request->tipekamar;
      $kamar->ID_TARIF_SEASON = $request->tarifseason;
      $kamar->save();

      Alert::success('Kamar Diperbarui', 'SUKSES')->persistent('Close');
      return redirect()->route('kamar.tampil');
    }







    //Pengelolaan Tipe Kamar
    public function tampiltipekamar()
    {
      $kamar = DetilKamar::orderBy('ID_DETIL_KAMAR')->paginate(page);
      return view('tipekamar.index', compact('kamar'));
    }

    public function pencarianTipeKamar(Request $request)  // Mencari Kamar
    {
      //Search Berdasarkan
      $katakunci = $request->input('katakunci');
      $kamar = DetilKamar::orderBy('ID_DETIL_KAMAR')->where(function($q) use ($katakunci){
          $q->where('NAMA_KAMAR','LIKE',"%$katakunci%")
          ->orWhere('FASILITAS','LIKE',"%$katakunci%")
          ->orWhere('JUMLAH_KAMAR',$katakunci);
      })->paginate(page);
      
      $kamar->appends(['katakunci' => $katakunci]);
      return view('tipekamar.index', compact('kamar'));
    }

    public function tambahtipekamar()
    {
      return view('tipekamar.tambah');
    }

    public function simpantipekamar(Request $request)
    {
      $kamar = new DetilKamar();
      $kamar->NAMA_KAMAR = $request->namakamar;
      $kamar->JUMLAH_KAMAR = $request->jumlah;
      $kamar->FASILITAS = $request->fasilitas;
      $kamar->save();

      Alert::success('Berhasil Menambahkan Tipe Kamar' , 'SUKSES')->persistent('Close');
      return redirect()->route('tipekamar.tampil');
    }

    public function ubahTipeKamar($id)
    {
      $kamar = DetilKamar::FindorFail($id);
      return view('tipekamar.ubah', compact('kamar'));
    }

    public function simpanPerubahanTipeKamar(Request $request, $id)
    {
      $kamar = DetilKamar::FindorFail($id);
      $kamar->NAMA_KAMAR = $request->namakamar;
      $kamar->JUMLAH_KAMAR = $request->jumlah;
      $kamar->FASILITAS = $request->fasilitas;
      $kamar->save();

      Alert::success('Berhasil Mengubah Tipe Kamar' , 'SUKSES')->persistent('Close');
      return redirect()->route('tipekamar.tampil');
    }

    public function hapusTipeKamar($id)
    {
      $kamar = DetilKamar::FindorFail($id);
      $kamar->delete();

      Alert::success('Berhasil Menghapus Tipe Kamar' , 'SUKSES')->persistent('Close');
      return redirect()->route('tipekamar.tampil');
    }
}
