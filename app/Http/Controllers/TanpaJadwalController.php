<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use App\Pengampu;
use Illuminate\Http\Request;

class TanpaJadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $matkuls = Pengampu::join('mata_kuliahs','mata_kuliahs.id','pengampus.matkul_id')
                            ->leftJoin('dosens','dosens.nip','pengampus.nip')
                            ->select('mata_kuliahs.prodi','nm_matkul','nm_dosen','mata_kuliahs.kelas')
                            ->whereNotIn('pengampus.id', function($query){
                                $query->select('pengampu_id')->from('jadwals')->get();
                            })
                            ->get();
        return view('operator/tanpa_jadwal.index',compact('matkuls'));
    }
}
