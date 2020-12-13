<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\PenggunaRuang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\PandaController;

class RuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $ruangans = PenggunaRuang::join('ruangans','ruangans.id','pengguna_ruangs.ruang_id')->get();
        $panda = new PandaController();
        $prodi = '
            {fakultas(fakKode:7) {
                fakKode
                prodi {
                    prodiNamaResmi
                }
            }}
        ';
        $prodis = $panda->panda($prodi);
        return view('operator/ruangan.index',compact('ruangans','prodis'));
    }

    public function post(Request $request){
        $this->validate($request,[
            'nm_ruangan' =>  'required',
            'prodi' =>  'required',
            'kapasitas' =>  'required',
        ]);

        Ruangan::create([
            'nm_ruangan'    =>  $request->nm_ruangan,
            'prodi'    =>  $request->prodi,
            'kapasitas'    =>  $request->kapasitas,
        ]);

        return redirect()->route('operator.ruangan')->with(['success'    =>  'Ruangan Pemira Berhasil Ditambahkan !!']);
    }

    public function delete(Request $request){
        $ruangan = Ruangan::where('id',$request->id)->delete();
        return redirect()->route('operator.ruangan')->with(['success' =>  'Ruangan Pemira Berhasil Di Hapus !!']);
    }
}
