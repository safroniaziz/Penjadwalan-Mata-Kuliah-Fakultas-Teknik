<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('pengampu_id');
            $table->string('hari');
            $table->string('nm_matkul');
            $table->string('kode_matkul');
            $table->string('kelas');
            $table->string('nm_dosen');
            $table->string('prodi');
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->string('durasi');
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
        Schema::dropIfExists('jadwals');
    }
}
