<?php

namespace App\Http\Controllers;

use App\Hari;
use App\Ruangan;
use App\PenggunaRuang;
use App\Jadwal;
use App\Pengampu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('operator/jadwal.index');
    }

    public function generateJadwal(){
        Jadwal::truncate();
        $hari = Hari::all();
        $ruangan = PenggunaRuang::join('ruangans','ruangans.id','pengguna_ruangs.ruang_id')->get();
        $data = [];
        for ($i=0; $i <count($hari) ; $i++) { 
            for ($j=0; $j <count($ruangan) ; $j++) { 
                $prodi = PenggunaRuang::select('nm_prodi')->where('ruang_id',$ruangan[$j]->ruang_id)->get();
                $durasi = Jadwal::select(DB::raw('sum(durasi) as durasi'))
                                    ->where('ruang_id',$ruangan[$j]['ruang_id'])
                                    ->where('hari',$hari[$i]['nm_hari'])
                                    ->first();
                                // return $jam_mulai;
                               
                            //    return $jam_mulai;
                while ($durasi->durasi <= 480) {
                    if ($durasi->durasi >380 AND $durasi->durasi <420) {
                        $pengampu = Pengampu::join('mata_kuliahs','mata_kuliahs.id','pengampus.matkul_id')
                                    ->leftJoin('dosens','dosens.nip','pengampus.nip')
                                    ->inRandomOrder()
                                    ->select('pengampus.id','sks','nm_matkul','kode_matkul','mata_kuliahs.prodi','mata_kuliahs.kelas','dosens.nm_dosen')
                                    ->whereNotIn('pengampus.id', function($query){
                                        $query->select('pengampu_id')->from('jadwals')->get();
                                    })
                                    ->where('jumlah_mahasiswa','<=',$ruangan[$j]['kapasitas'])
                                    ->whereIN('mata_kuliahs.prodi',$prodi)
                                    ->where('sks','1')
                                    ->take(1)
                                ->get();
                    }
                    elseif ($durasi->durasi >370 AND $durasi->durasi <= 380) {
                        $pengampu = Pengampu::join('mata_kuliahs','mata_kuliahs.id','pengampus.matkul_id')
                                    ->leftJoin('dosens','dosens.nip','pengampus.nip')
                                    ->inRandomOrder()
                                    ->select('pengampus.id','sks','nm_matkul','kode_matkul','mata_kuliahs.prodi','mata_kuliahs.kelas','dosens.nm_dosen')
                                    ->whereNotIn('pengampus.id', function($query){
                                        $query->select('pengampu_id')->from('jadwals')->get();
                                    })
                                    ->where('jumlah_mahasiswa','<=',$ruangan[$j]['kapasitas'])
                                    ->whereIN('mata_kuliahs.prodi',$prodi)
                                    ->where('sks','2')
                                    ->take(1)
                                ->get();
                    }
                    elseif ($durasi->durasi > 420) {
                        break;
                    }
                    else{
                        $pengampu = Pengampu::join('mata_kuliahs','mata_kuliahs.id','pengampus.matkul_id')
                                    ->leftJoin('dosens','dosens.nip','pengampus.nip')
                                    ->inRandomOrder()
                                    ->select('pengampus.id','sks','nm_matkul','kode_matkul','mata_kuliahs.prodi','mata_kuliahs.kelas','dosens.nm_dosen')
                                    ->whereNotIn('pengampus.id', function($query){
                                        $query->select('pengampu_id')->from('jadwals')->get();
                                    })
                                    ->where('jumlah_mahasiswa','<=',$ruangan[$j]['kapasitas'])
                                    ->whereIN('mata_kuliahs.prodi',$prodi)
                                    ->take(1)
                                ->get();
                    }

                   if (count($pengampu) > 0) {
                    $jam_mulai = Jadwal::select('jam_mulai')
                                        ->where('ruang_id',$ruangan[$j]['ruang_id'])
                                        ->where('hari',$hari[$i]['nm_hari'])
                                        ->latest('id')
                                        ->get();

                        if (count($jam_mulai)<1) {
                            // return 'b';
                            $jam = "08:00";
                            $a = (($pengampu[0]['sks'] * 50) +10) *60;
                            // return $a;
                            // return $pengampu[0]['sks'] * 50 +10;
                            // return $jam;
                            Jadwal::create(
                                [
                                    'hari'  =>  $hari[$i]['nm_hari'],
                                    'ruang_id'  =>  $ruangan[$j]['id'],
                                    'nm_matkul' =>  $pengampu[0]->nm_matkul,
                                    'kode_matkul' =>  $pengampu[0]->kode_matkul,
                                    'kelas' =>  $pengampu[0]->kelas,
                                    'prodi' =>  $pengampu[0]->prodi,
                                    'nm_dosen' =>  $pengampu[0]->nm_dosen,
                                    'pengampu_id'   =>  $pengampu[0]->id,
                                    'durasi'    =>  ($pengampu[0]['sks'] * 50) +10,
                                    'jam_mulai' =>  $jam,
                                    'jam_selesai'   =>  date("H:i",strtotime($jam) + $a)
                                ]
                            );
                        }
                        else{
                            $jam_selesai2 = Jadwal::select('jam_selesai')
                                            ->where('ruang_id',$ruangan[$j]['ruang_id'])
                                            ->where('hari',$hari[$i]['nm_hari'])
                                            ->latest('id')
                                            ->first();
                            $jam = $jam_selesai2['jam_selesai'];
                            $a = (($pengampu[0]['sks'] * 50) +10) *60;

                            Jadwal::create(
                                [
                                    'hari'  =>  $hari[$i]['nm_hari'],
                                    'ruang_id'  =>  $ruangan[$j]['id'],
                                    'nm_matkul' =>  $pengampu[0]->nm_matkul,
                                    'kode_matkul' =>  $pengampu[0]->kode_matkul,
                                    'kelas' =>  $pengampu[0]->kelas,
                                    'prodi' =>  $pengampu[0]->prodi,
                                    'nm_dosen' =>  $pengampu[0]->nm_dosen,
                                    'pengampu_id'   =>  $pengampu[0]->id,
                                    'durasi'    =>  ($pengampu[0]['sks'] * 50) +10,
                                    'jam_mulai' =>  $jam,
                                    'jam_selesai'   =>  date("H:i",strtotime($jam) + $a)
                                ]
                            );
                        }
                   }
                   else{
                        break;
                   }
                   $durasi = Jadwal::select(DB::raw('sum(durasi) as durasi'))
                                    ->where('ruang_id',$ruangan[$j]['ruang_id'])
                                    ->where('hari',$hari[$i]['nm_hari'])
                                    ->first();
                   if ($durasi->durasi > 480) {
                        break;
                   }
                }
            }
        }
        return redirect()->route('operator.jadwal')->with(['success'    =>  'Jadwal Perkuliahan Berhasil di Generate !!']);
    }

    public function cariJadwal(Request $request){
        if (isset($_GET['prodi']) && isset($_GET['hari'])) {
            if ($_GET['prodi'] == "semua" && $_GET['hari'] =="semua") {
                $jadwals = Jadwal::join('ruangans','ruangans.id','jadwals.ruang_id')
                                    ->select('jadwals.id','nm_ruangan','hari','nm_matkul','kelas','nm_dosen','prodi','jam_mulai','jam_selesai','durasi')
                                    ->get();
                return view('operator/jadwal.index',compact('jadwals'));
            } elseif ($_GET['prodi'] == "semua" && $_GET['hari'] != "semua") {
                $jadwals = Jadwal::join('ruangans','ruangans.id','jadwals.ruang_id')
                                    ->select('jadwals.id','nm_ruangan','hari','nm_matkul','kelas','nm_dosen','prodi','jam_mulai','jam_selesai','durasi')
                                    ->where('hari',$_GET['hari'])
                                    ->get();
                return view('operator/jadwal.index',compact('jadwals'));
            } elseif ($_GET['prodi'] != "semua" && $_GET['hari'] == "semua") {
                $jadwals = Jadwal::join('ruangans','ruangans.id','jadwals.ruang_id')
                                    ->select('jadwals.id','nm_ruangan','hari','nm_matkul','kelas','nm_dosen','prodi','jam_mulai','jam_selesai','durasi')
                                    ->where('prodi',$_GET['prodi'])
                                    ->get();
                return view('operator/jadwal.index',compact('jadwals'));
            } else {
                $jadwals = Jadwal::join('ruangans','ruangans.id','jadwals.ruang_id')
                                    ->select('jadwals.id','nm_ruangan','hari','nm_matkul','kelas','nm_dosen','prodi','jam_mulai','jam_selesai','durasi')
                                    ->where('prodi',$_GET['prodi'])
                                    ->where('hari',$_GET['hari'])
                                    ->get();
                return view('operator/jadwal.index',compact('jadwals'));
            }
        }
    }

    public function ubahJadwal($id){
        $id_dari = $id;
        $dari = Jadwal::join('ruangans','ruangans.id','jadwals.ruang_id')
                        ->where('jadwals.id',$id)
                        ->first();
        $prodi = Jadwal::join('ruangans','ruangans.id','jadwals.ruang_id')
                        ->select('prodi')
                        ->where('jadwals.id',$id)
                        ->first();
        $jadwals = Jadwal::join('ruangans','ruangans.id','jadwals.ruang_id')
                            ->select('jadwals.id','nm_ruangan','hari','nm_matkul','kelas','nm_dosen','prodi','jam_mulai','jam_selesai','durasi')
                            ->where('prodi',$prodi->prodi)
                            ->where('jadwals.id','!=',$id_dari)
                            ->get();
        return view('operator.jadwal.ubah_jadwal',compact('id_dari','dari','prodi','jadwals'));
    }

    public function ubahJadwalPost($id_dari, $id){
        $dari = Jadwal::find($id_dari);
        $ke  = Jadwal::find($id);
        
        Jadwal::where('id',$id_dari)->update([
            'hari'  =>  $ke->hari,
            'jam_mulai'  =>  $ke->jam_mulai,
            'jam_selesai'  =>  $ke->jam_selesai,
            'ruang_id'  =>  $ke->ruang_id,
        ]);

        Jadwal::where('id',$id)->update([
            'hari'  =>  $dari->hari,
            'jam_mulai'  =>  $dari->jam_mulai,
            'jam_selesai'  =>  $dari->jam_selesai,
            'ruang_id'  =>  $dari->ruang_id,
        ]);

        return redirect()->route('operator.jadwal')->with(['success'    =>  'Jadwal Perkuliahan Berhasil diubah !!']);
    }
}
