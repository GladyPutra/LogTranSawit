<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KraniController extends Controller
{
    public function tambahpanen(Request $r)
    {
    	 $this->validate($r,[
            'panen'=>'required|numeric'
            ]);

      $taksasi = \App\Taksasi::where('id_blok',$r->idblok)->first();
      $taksasi->panen = $r->panen;
      $taksasi->save();

      return redirect()->route('peta-krani');
    }
}
