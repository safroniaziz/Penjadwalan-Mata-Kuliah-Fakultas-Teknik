<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = [
        'kode_matkul','nm_matkul','kelas','sks','semid','prodi','jumlah_mahasiswa','semester_matkul'
    ];
}
