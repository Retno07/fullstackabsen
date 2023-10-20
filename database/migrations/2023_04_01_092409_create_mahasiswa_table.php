<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('nim_mahasiswa');
            $table->string('nama_mahasiswa', 100);
            $table->integer('id_prodi');
            $table->integer('tahun_masuk');
            $table->integer('id_dosen');
            $table->string('email_mahasiswa', 50);
            $table->string('password_mahasiswa', 100);
            $table->softDeletes();
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
        Schema::dropIfExists('mahasiswa');
    }
}
