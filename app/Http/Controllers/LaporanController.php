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
use App\Reservasi;
use App\DetilReservasi;
use App\DataDiri;
use App\Kamar;
use App\Kota;
use App\Tarif;
use App\Transaksi;
define('page', 10);

class LaporanController extends Controller
{
    public function LaporanPendapatanPerJenisTamu()
    {
    	$tahun = Carbon::now()->year;
    	$laporan = Transaksi::orderBy('TGL_TRANSAKSI')->whereYear('TGL_TRANSAKSI', $tahun)
    	// ->whereHas('detilreservasi', function($r){
     //  		$r->where('detil_reservasi.JENIS_TAMU', 'Personal');
	    // })
	    ->get();
    	return view('laporan.laporan_pendapatan_per_jenis_tamu', compact('laporan','tahun'));
    }

    public function FilterLaporanPendapatanPerJenisTamu(Request $request)
    {
    	$tahun = $request->input('tahun');
    	$laporan = Transaksi::orderBy('TGL_TRANSAKSI')->whereYear('TGL_TRANSAKSI', $tahun)->get();
    	return view('laporan.laporan_pendapatan_per_jenis_tamu', compact('laporan','tahun'));
    }



    public function LaporanJumlahTamuPerJenisKamar()
    {
    	$tahun = Carbon::now()->year;
    	$laporan = Transaksi::orderBy('TGL_TRANSAKSI')->whereYear('TGL_TRANSAKSI', $tahun)->get();
    	return view('laporan.laporan_jumlah_tamu_per_jenis_kamar', compact('laporan','tahun'));
    }

    public function FilterLaporanJumlahTamuPerJenisKamar(Request $request)
    {
    	$tahun = $request->input('tahun');
    	$laporan = Transaksi::orderBy('TGL_TRANSAKSI')->whereYear('TGL_TRANSAKSI', $tahun)->get();
    	return view('laporan.laporan_jumlah_tamu_per_jenis_kamar', compact('laporan','tahun'));
    }



    public function LaporanPendabaranPerCabang()
    {
    	$tahun = Carbon::now()->year;
    	// $laporan = Transaksi::orderBy('TGL_TRANSAKSI')->whereYear('TGL_TRANSAKSI', $tahun)
	    // ->get();
    	
    	$laporan = DB::table('transaksi')
            ->join('reservasi', 'transaksi.ID_BOOKING', '=', 'reservasi.ID_BOOKING')
            ->join('kota', 'reservasi.ID_KOTA', '=', 'kota.ID_KOTA')
            ->select(DB::raw('NAMA_KOTA'), DB::raw('sum(JUMLAH_TARIF) as TOTAL'))
            ->groupBy(DB::raw('NAMA_KOTA'))
            ->where(DB::raw('YEAR(TGL_TRANSAKSI)'),$tahun)
            ->orderBy(DB::raw('NAMA_KOTA'))
            ->get();

    	return view('laporan.laporan_jumlah_pendapatan_per_cabang', compact('laporan','tahun'));
    }

    public function FilterLaporanPendabaranPerCabang(Request $request)
    {
    	$tahun = $request->input('tahun');
    	$laporan = DB::table('transaksi')
            ->join('reservasi', 'transaksi.ID_BOOKING', '=', 'reservasi.ID_BOOKING')
            ->join('kota', 'reservasi.ID_KOTA', '=', 'kota.ID_KOTA')
            ->select(DB::raw('NAMA_KOTA'), DB::raw('sum(JUMLAH_TARIF) as TOTAL'))
            ->groupBy(DB::raw('NAMA_KOTA'))
            ->where(DB::raw('YEAR(TGL_TRANSAKSI)'),$tahun)
            ->orderBy(DB::raw('NAMA_KOTA'))
            ->get();

    	return view('laporan.laporan_jumlah_pendapatan_per_cabang', compact('laporan','tahun'));
    }



    public function LaporanJumlahTamu()
    {
    	$tahun = Carbon::now()->year;
    	// $laporan = DataDiri::orderBy('TGL_BUAT')->whereYear('TGL_BUAT', $tahun)->sum('ID_DATA_DIRI')->groupBy($tahun)->get();
    	$laporan = DB::table('data_diri')
		    ->select(DB::raw('MONTH(TGL_BUAT) as BULAN'), DB::raw('count(ID_DATA_DIRI) as TOTAL'))
		    ->groupBy(DB::raw('MONTH(TGL_BUAT)'))
		    ->where(DB::raw('YEAR(TGL_BUAT)'),$tahun)
		    ->get();
    	// dd($laporan);
    	return view('laporan.laporan_jumlah_tamu_per_bulan', compact('laporan','tahun'));
    }

    public function FilterLaporanJumlahTamu(Request $request)
    {
    	$tahun = $request->input('tahun');
    	$laporan = DB::table('data_diri')
		    ->select(DB::raw('MONTH(TGL_BUAT) as BULAN'), DB::raw('count(ID_DATA_DIRI) as TOTAL'))
		    ->groupBy(DB::raw('MONTH(TGL_BUAT)'))
		    ->where(DB::raw('YEAR(TGL_BUAT)'),$tahun)
		    ->get();
    	return view('laporan.laporan_jumlah_tamu_per_bulan', compact('laporan','tahun'));
    }




    public function LaporanReservasiTerbanyak()
    {
    	$tahun = Carbon::now()->year;
    	// $laporan = Transaksi::orderBy('TGL_TRANSAKSI')->groupBy('NAMA')->get();
    	$laporan = DB::table('transaksi')
    		->join('reservasi','transaksi.ID_BOOKING','=','reservasi.ID_BOOKING')
    		->join('data_diri','reservasi.ID_DATA_DIRI','=','data_diri.ID_DATA_DIRI')
		    ->select(DB::raw('NAMA'), DB::raw('count(NO_INVOICE) as TOTAL'))
		    ->groupBy(DB::raw('NAMA'))
		    ->orderBy(DB::raw('TOTAL'),'DESC')
		    ->limit(5)
		    ->get();

    	return view('laporan.laporan_reservasi_terbanyak', compact('laporan','tahun'));
    }

    public function FilterLaporanReservasiTerbanyak(Request $request)
    {
    	$tahun = $request->input('tahun');
    	$laporan = Transaksi::orderBy('TGL_TRANSAKSI')->whereYear('TGL_TRANSAKSI', $tahun)->get();
    	return view('laporan.laporan_reservasi_terbanyak', compact('laporan','tahun'));
    }
}
