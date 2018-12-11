<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManpabrikController extends Controller
{
    public function beranda()
    {

      $sum1 = \App\Kapasitas::where('tgl',date("Y-m-d", strtotime("-1 day")))->sum('kapasitas');
      $sum2 = \App\Kapasitas::where('tgl',date("Y-m-d", strtotime("-2 day")))->sum('kapasitas');
      $sum3 = \App\Kapasitas::where('tgl',date("Y-m-d", strtotime("-3 day")))->sum('kapasitas');
      $sum4 = \App\Kapasitas::where('tgl',date("Y-m-d", strtotime("-4 day")))->sum('kapasitas');
      $sum5 = \App\Kapasitas::where('tgl',date("Y-m-d"))->sum('kapasitas');
      return view('managerpabrik.beranda',compact('sum1','sum2','sum3','sum4','sum5'));
    }

    public function kelolashift()
    {
       return view('managerpabrik.shift');
    }

    public function tambahshift(Request $r)
    {
      $this->validate($r,[
            'shift'=>'required',
            'jam_awal'=>'required',
            'jam_akhir'=>'required'
            ]);

      $shi = new \App\Shift;
      $shi->shift = $r->shift;
      $shi->jam_awal = $r->jam_awal;
      $shi->jam_akhir = $r->jam_akhir;
      $shi->save();

      return redirect()->route('kelolashift');
    }

    public function editshift(Request $r)
    {
      $this->validate($r,[
            'shift'=>'required',
            'jam_awal'=>'required',
            'jam_akhir'=>'required'
            ]);

      $shi = \App\Shift::where('id',$r->idshift)->first();
      $shi->shift = $r->shift;
      $shi->jam_awal = $r->jam_awal;
      $shi->jam_akhir = $r->jam_akhir;
      $shi->save();

      return redirect()->route('kelolashift');
    }

    public function deleteshift($id)
    {
      $shi = \App\Shift::where('id',$id)->first()->delete();
      return redirect()->route('kelolashift');
    }

    public function kelolakapasitas()
    {
        foreach(\App\Shift::all() as $sf)
        {
            if(!\App\Kapasitas::where('tgl',date("Y-m-d"))->where('shift',$sf->shift)->first())
            {
              $kp = new \App\Kapasitas;
              $kp->shift = $sf->shift;
              $kp->tgl = date("Y-m-d");
              $kp->kapasitas = 0;
              $kp->save();
            }
         
        }
        return view('managerpabrik.kapasitas');
        
    }

    public function editkapasitas(Request $r)
    {
       $this->validate($r,[
            'kapasitas'=>'required|numeric'
            ]);

      $kp = \App\Kapasitas::where('id',$r->idkapasitas)->first();
      $kp->kapasitas = $r->kapasitas;
      $kp->save();

      return redirect()->route('kelolakapasitas');
    }

    public function deletekapasitas($id)
    {
      $kp = \App\Kapasitas::where('id',$id)->first()->delete();
      return redirect()->route('kelolakapasitas');
    }

    public function displayangkut()
    {
      return view('managerpabrik.displayangkat');
    }

    public function displayangkut_ajax($id_afd)
    {
      $afdeling = \App\Afdeling::where('id_afdeling',$id_afd)->first();
      return view('ajax-component.displayangkut',compact('afdeling'));
    }

    public function refreshcoord()
    {
      $coord=[];
      $data=[];
      $i = 0;
      $j = 0;
      foreach(\App\DistribusiPanen::where('created_at',date('Y-m-d'))->where('status',0)->get() as $dp)
      {
        $i = 0;
        foreach(\App\KoordinatDistribusi::where('id_distribusi',$dp->id)->get() as $kd)
        {
          $temp = array("lat" => $kd->latitude,"lng" => $kd->longitude);
          //array_push($coord,"lat"=>$kd->latitude,"long"=>$kd->longitude);
          $coord[$j][$i] = $temp;

          $i++;
        }
        $data[$j] = array($dp->berat,\App\User::where('id_user',$dp->id_user)->pluck('username')->first());
        $j++;
      }
      return array($coord,$data);
    }

    public function refreshcoordhistori(Request $r)
    {
      $coord=[];
      $data=[];
      $i = 0;
      $j = 0;
      foreach(\App\DistribusiPanen::where('status',1)->whereDate('created_at',$r->tanggal)->get() as $dp)
      {
        $i = 0;
        foreach(\App\KoordinatDistribusi::where('id_distribusi',$dp->id)->get() as $kd)
        {
          $temp = array("lat" => $kd->latitude,"lng" => $kd->longitude);
          //array_push($coord,"lat"=>$kd->latitude,"long"=>$kd->longitude);
          $coord[$j][$i] = $temp;

          $i++;
        }
        $data[$j] = array($dp->berat,\App\User::where('id_user',$dp->id_user)->pluck('username')->first());
        $j++;
      }
      \Log::info(json_encode($coord));
      return array($coord,$data);
    }


    public function historidistribusi($tanggal)
    {
      return view('managerpabrik.historidistribusi',compact('tanggal'));
    }

    public function tanggaldistribusi()
    {
      return view('managerpabrik.tanggaldistribusi');
    }
}
