<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Alert;
use App\Tarif;
use App\Season;

class TarifSeasonController extends Controller
{
    public function index()
    {
    	$tarif = Tarif::orderBy('ID_TARIF')->paginate(5);
    	$season = Season::orderBy('ID_SEASON')->paginate(5);

    	$dataTarif = $dataSeason = null;
    	$list = ['tarif', 'season', 'dataTarif', 'dataSeason'];
    	return view('tarif_season', compact($list));
    }

    public function simpanTarif(Request $request)
    {
    	if($request->idTarif == "")
	    {
	        $tarif = new Tarif();
	        $tarif->HARGA_TARIF = $request->tarifbaru;
	        $tarif->save();
	        Alert::success('Tarif Baru Berhasil Disimpan' , 'SUKSES')->persistent('Close');
	    }
	    else
	    {
	    	$tarif = Tarif::FindOrFail($request->idTarif);
	    	$tarif->HARGA_TARIF = $request->tarifbaru;
	    	$tarif->save();
	    	Alert::success('Tarif Berhasil Diperbarui' , 'SUKSES')->persistent('Close');
	    }
        return redirect()->route('tarifseason.tampil', compact('tarif'));
    }

    public function editTarif($id)
    {
    	$tarif = Tarif::orderBy('ID_TARIF')->paginate(5);
    	$season = Season::orderBy('ID_SEASON')->paginate(5);

        $dataTarif = Tarif::FindOrFail($id);
        $dataSeason = null;
        $list = ['tarif', 'season','dataTarif', 'dataSeason'];
        return view('tarif_season', compact($list));
    }

    public function hapusTarif($id)
    {
        $tarif = Tarif::FindOrFail($id);
        $tarif->delete();

        Alert::error('Tarif Berhasil Dihapus' , 'SUKSES')->persistent('Close');
        return redirect()->route('tarifseason.tampil');
    }




    public function simpanSeason(Request $request)
    {
    	if($request->idSeason == "")
	    {
	        $season = new Season();
	        $season->NAMA_SEASON = $request->seasonbaru;
	        $season->save();

	        Alert::success('Season Baru Berhasil Disimpan' , 'SUKSES')->persistent('Close');
	    }
	    else
	    {
	    	$season = Season::FindOrFail($request->idSeason);
	    	$season->NAMA_SEASON = $request->seasonbaru;
	    	$season->save();
	    	Alert::success('Seasion Berhasil Diperbarui' , 'SUKSES')->persistent('Close');
	    }
        return redirect()->route('tarifseason.tampil');
    }

    public function editSeason($id)
    {
    	$tarif = Tarif::orderBy('ID_TARIF')->paginate(5);
    	$season = Season::orderBy('ID_SEASON')->paginate(5);

        $dataTarif = null;
        $dataSeason = Season::FindOrFail($id);;
        $list = ['tarif', 'season','dataTarif', 'dataSeason'];
        return view('tarif_season', compact($list));
    }

    public function hapusSeason($id)
    {
        $season = Season::FindOrFail($id);
        $season->delete();

        Alert::error('Season Berhasil Dihapus' , 'SUKSES')->persistent('Close');
        return redirect()->route('tarifseason.tampil');
    }
}
