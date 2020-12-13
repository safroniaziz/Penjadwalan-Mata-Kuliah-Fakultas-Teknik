<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Jadwal;
use App\MataKuliah;
use App\Pengampu;
use Illuminate\Http\Request;

class DashboardOperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        $dosen = Count(Dosen::all());
        $matkul = Count(MataKuliah::all());
        $jadwal = Count(Jadwal::all());
        $a = Pengampu::join('mata_kuliahs','mata_kuliahs.id','pengampus.matkul_id')
                        ->leftJoin('dosens','dosens.nip','pengampus.nip')
                        ->select('mata_kuliahs.prodi','nm_matkul','nm_dosen','mata_kuliahs.kelas')
                        ->whereNotIn('pengampus.id', function($query){
                            $query->select('pengampu_id')->from('jadwals')->get();
                        })
                        ->get();
        $tidak_terjadwal = count($a);
        return view('operator.dashboard',compact('dosen','matkul','jadwal','tidak_terjadwal'));
    }
}
