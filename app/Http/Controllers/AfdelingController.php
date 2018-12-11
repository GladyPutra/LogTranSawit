<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfdelingController extends Controller
{
    public function simpan(Request $r)
    {
      $this->validate($r,[
            'favcolor'=>'required',
            'deskripsi'=>'required',
            'pengelola'=>'required|min:1',
            'coord'=>'required|between:10,5000'
            ]);

        $afd = new \App\Afdeling;
        $afd->jumlah_pohon = 0;
        $afd->koordinat = $r->coord;
        $afd->deskripsi = $r->deskripsi;
        $afd->id_user = $r->pengelola;
        $afd->warna = $r->favcolor;
        $afd->save();

        return redirect()->route('tampilpeta');
    }

    public function petaasisten()
    {
      $tahunanbuah = 0;
      $tahunanberat = 0;
      $bulananberat = 0;
      $bulananbuah = 0;
      $mingguanbuah = 0;
      $mingguanberat = 0;
      $harianberat = 0;
      $harianbuah = 0;

      if(\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
      ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
      ->where('afdeling.id_user',\Auth::user()->id_user)->count())
      {
        $tahunanberat = (\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.tahunan') *
        (\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.rerata_berat')/
        \DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->count()))*365;

        $tahunanbuah = \DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.tahunan');

        $bulananberat = (\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.bulanan') *
        (\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.rerata_berat')/
        \DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->count()))*30;

        $bulananbuah = \DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.bulanan');

        $mingguanberat = (\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.mingguan') *
        (\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.rerata_berat')/
        \DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->count()))*7;

        $mingguanbuah = \DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.mingguan');

        $harianberat = (\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.harian') *
        (\DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.rerata_berat')/
        \DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->count()));

        $harianbuah = \DB::table('taksasi')->join('blok','taksasi.id_blok','=','blok.id_blok')
        ->join('afdeling','afdeling.id_afdeling','=','blok.id_afdeling')
        ->where('afdeling.id_user',\Auth::user()->id_user)->sum('taksasi.harian');
      }





      return view('peta-assisten.peta',compact('tahunanberat','tahunanbuah','bulananberat','bulananbuah','mingguanberat','mingguanbuah','harianbuah','harianberat'));
    }

    public function delete(Request $r)
    {
        $taksasi = \App\Taksasi::where('id_blok',\App\Blok::where('id_afdeling',$r->afd)->pluck('id_blok')->first())->delete();
        $blok = \App\Blok::where('id_afdeling',$r->afd)->delete();
        $afd = \App\Afdeling::find($r->afd)->delete();
        return redirect()->route('tampilpeta');
    }

    public function tambahblok(Request $r)
    {
      $this->validate($r,[
            'jumlahpohon'=>'numeric',
            'deskripsi'=>'required',
            'afdeling'=>'required',
            'coord'=>'required|between:10,5000',
            'hari'=>'required'
            ]);

      $blok = new \App\Blok;
      $blok->jumlah_pohon = $r->jumlahpohon;
      $blok->deskripsi = $r->deskripsi;
      $blok->koordinat = $r->coord;
      $blok->id_afdeling = $r->afdeling;
      $blok->hari_panen = $r->hari;
      $blok->save();

      $afd = \App\Afdeling::where('id_afdeling',$r->afdeling)->first();
      $afd->jumlah_pohon = \App\Blok::where('id_afdeling',$r->afdeling)->sum('jumlah_pohon');
      $afd->save();

      $krani = new \App\Krani;
      $krani->id_user = $r->pengelola;
      $krani->id_blok = \App\Blok::max('id_blok');
      $krani->save();

      return redirect()->route('tampilpeta');
    }

    public function tambahtph(Request $r)
    {
      $this->validate($r,[
            'kapasitas'=>'numeric',
            'deskripsi'=>'required',
            'blok'=>'required',
            'coord'=>'required|between:10,5000',
            'panen'=>'numeric',
            ]);

      $tph = new \App\TPH;
      $tph->kapasitas = $r->kapasitas;
      $tph->deskripsi = $r->deskripsi;
      $tph->koordinat = $r->coord;
      $tph->id_blok = $r->blok;
      $tph->panen = $r->panen;
      $tph->save();

      $afd = \App\Blok::where('id_blok',$r->blok)->first();
      // $afd->jumlah_pohon = \App\Blok::where('id_afdeling',$r->afdeling)->sum('jumlah_pohon');
      $afd->save();

      // $krani = new \App\Krani;
      // $krani->id_user = $r->pengelola;
      // $krani->id_blok = \App\Blok::max('id_blok');
      // $krani->save();

      return redirect()->route('tampilpeta');
    }


    public function tambahtaksasi(Request $r)
    {
       $this->validate($r,[
            'harian'=>'required|numeric',
            'mingguan'=>'required|numeric',
            'bulanan'=>'required|numeric',
            'tahunan'=>'required|numeric',
            'rata'=>'required|numeric',
            'idblok'=>'required'
            ]);

      $tak = new \App\Taksasi;
      $tak->harian = $r->harian;
      $tak->mingguan = $r->mingguan;
      $tak->bulanan = $r->bulanan;
      $tak->tahunan = $r->tahunan;
      $tak->rerata_berat = $r->rata;
      $tak->id_blok = $r->idblok;
      $tak->save();

      return redirect()->route('tampilpeta2');
    }

    public function getstatus(Request $r)
    {
      if(count(\App\Blok::where('id_afdeling',$r->id)->get()))
      {
        return 'no';
      }
      else {
        return 'yes';
      }
    }

    public function showblok(Request $r)
    {
      $blok = \App\Blok::where('id_afdeling',$r->id)->get();
      return view('ajax-component.displayblok',compact('blok'));
    }

    public function hapusblok(Request $r)
    {
        try
        {
            if(!\App\TPH::where('id_blok',$r->blok)->first())
            {
                $krani = \App\Krani::where('id_blok',$r->blok)->first()->delete();
            }
            
              $blok = \App\Blok::where('id_blok',$r->blok)->first()->delete();
              return redirect()->route('tampilpeta');
              
        }
        catch(\Exception $e)
        {
          return redirect()->back()->with('error','gagal menghapus blok karena masih berisi tph');
        }
        
      
    }
    
    public function deletetph(Request $r)
    {
        if(!isset($r->id))
        {
             return redirect()->back()->with('error','tidak ada tph yabf dihapus');
            
            
        }
        else
        {
           $tph = \App\TPH::where("id_tph",$r->id)->first()->delete();
            return redirect()->back();
        }
        
    }
    
    public function refreshtph($id_blok)
    {
        $id = $id_blok;
        return view('ajax-component.refreshtph',compact('id'));
    }
    
    public function refreshblok($id_afd)
    {
        $id = $id_afd;
        return view('ajax-component.refreshblok',compact('id'));
    }
}
