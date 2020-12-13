<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_matkul')->nullable();
            $table->string('nm_matkul')->nullable();
            $table->string('kelas')->nullable();
            $table->string('semester_matkul')->nullable();
            $table->string('sks')->nullable();
            $table->string('semid')->nullable();
            $table->string('jumlah_mahasiswa')->nullable();
            $table->string('prodi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mata_kuliahs');
    }
}
