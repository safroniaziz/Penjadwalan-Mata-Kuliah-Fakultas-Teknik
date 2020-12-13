<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\PandaController;

class MatkulController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function index(){
        $matkuls = MataKuliah::all();
        return view('operator/mata_kuliah.index',compact('matkuls'));
    }

    public function post(){
        $panda = new PandaController();
        $data = '
        {fakultas(fakKode:7) {
            fakKode
            fakNamaResmi
            prodi {
              prodiNamaResmi
                   dosen {
                     dsnPegNip
                kelas(klsSemId:20201) {
                  klsId
                  klsSemId
                  klsNama
                  matakuliah {
                    mkkurId
                    mkkurKode
                    mkkurNamaResmi
                    mkkurProdiKode
                    mkkurJumlahSksTeori
                  }
                }
                     pegawai {
                       pegNip
                  pegIsAktif
                       pegNama
               
                     }
                   }
            }
          }}
        ';
        $datas = $panda->panda($data);
        $matkul = [];
        for ($i=0; $i <count($datas['fakultas'][0]['prodi']) ; $i++) { 
            for ($a=0; $a <count($datas['fakultas'][0]['prodi'][$i]['dosen']) ; $a++) { 
                for ($j=0; $j <count($datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['kelas']) ; $j++) { 
                    if ($datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['pegawai']['pegIsAktif'] == 1 && strlen($datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['dsnPegNip']) >5 ) {
                        $data = MataKuliah::where('kode_matkul',$datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['kelas'][$j]['matakuliah']['mkkurKode'])
                                            ->where('kelas',$datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['kelas'][$j]['klsNama'])
                                            ->get();
                        if (count($data) >0) {
                            
                        }
                        else {
                            MataKuliah::create([
                                'kode_matkul' => $datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['kelas'][$j]['matakuliah']['mkkurKode'],
                                'nm_matkul' => $datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['kelas'][$j]['matakuliah']['mkkurNamaResmi'],
                                'kelas' => $datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['kelas'][$j]['klsNama'],
                                'sks' => $datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['kelas'][$j]['matakuliah']['mkkurJumlahSksTeori'],
                                'semid' => $datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['kelas'][$j]['klsSemId'],
                                'prodi' =>  $datas['fakultas'][0]['prodi'][$i]['prodiNamaResmi'],
                            ]);
                        }
                    }
                }
                
            }
        }
        return redirect()->route('operator.matkul')->with(['success' =>  'Data Mata Kuliah Berhasil Di Generate !!']);
    }
}
