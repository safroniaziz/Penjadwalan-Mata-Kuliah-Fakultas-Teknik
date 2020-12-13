<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;
use App\Http\Controllers\PandaController;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $dosens = Dosen::all();
        return view('operator/dosen.index',compact('dosens'));
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
        $dosen = [];
        for ($i=0; $i <count($datas['fakultas'][0]['prodi']) ; $i++) { 
            for ($a=0; $a <count($datas['fakultas'][0]['prodi'][$i]['dosen']) ; $a++) { 
                if ($datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['pegawai']['pegIsAktif'] == 1 && strlen($datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['dsnPegNip']) >5 ) {
                    $dosen[]    =   [
                        'prodi' =>  $datas['fakultas'][0]['prodi'][$i]['prodiNamaResmi'],
                        'nip' => $datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['dsnPegNip'],
                        'nm_dosen' => $datas['fakultas'][0]['prodi'][$i]['dosen'][$a]['pegawai']['pegNama'],
                    ];
                }
                
            }
        }
        Dosen::insert($dosen);
        return redirect()->route('operator.dosen')->with(['success' =>  'Data Dosen Berhasil Di Generate !!']);
    }
}
