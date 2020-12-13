<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $day = Carbon::now()->format( 'l' );
        if ($day == "Monday") {
            $hari = "Senin";
        } elseif ($day == "Tuesday") {
            $hari = "Selasa";
        } elseif ($day == "Wednesday") {
            $hari = "Rabu";
        } elseif ($day == "Thursday") {
            $hari = "Kamis";
        } elseif ($day == "Friday") {
            $hari = "Jumat";
        } elseif ($day == "Saturday") {
            $hari = "Sabtu";
        } else{
            $hari = "Minggu";
        }
        $informatikas = Jadwal::where('hari',"Selasa")->where('prodi','INFORMATIKA')->get();
        $sipils = Jadwal::where('hari',"Selasa")->where('prodi','TEKNIK SIPIL')->get();
        $mesins = Jadwal::where('hari',"Selasa")->where('prodi','TEKNIK MESIN')->get();
        $elektros = Jadwal::where('hari',"Selasa")->where('prodi','TEKNIK ELEKTRO')->get();
        $arsitekturs = Jadwal::where('hari',"Selasa")->where('prodi','ARSITEKTUR')->get();
        $sis = Jadwal::where('hari',"Selasa")->where('prodi','SISTEM INFORMASI')->get();
        return view('layouts.front', compact('hari','informatikas','sipils','mesins','elektros','arsitekturs','sis'));
    }
}
