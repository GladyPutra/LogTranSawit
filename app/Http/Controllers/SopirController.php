<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SopirController extends Controller
{
    public function angkutpanenindex()
    {
      return view('sopir.angkut-panen');
    }

    public function angkutpanen(Request $r)
    {

      for($i = 0;$i<sizeof($r->angkut);$i++)
      {
        $ts = \App\TrukSopir::where('id_user',\Auth::user()->id_user)->first();
        $ts->angkut = $r->angkut[$i];
        $ts->id_tph = $r->angkut[$i];
        $ts->save();

        $tph = \App\TPH::where('id_tph',$ts->id_tph)->first();
        $tph->panen = $r->sisa[$i];
        $tph->save();

        return redirect()->back();

        // dd($r->temp_id);
      }
    }
}
