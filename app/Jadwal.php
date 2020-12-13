<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'ruang_id','pengampu_id','hari','nm_matkul','kode_matkul','kelas','nm_dosen','prodi','jam_mulai','jam_selesai','durasi'
    ];
}
