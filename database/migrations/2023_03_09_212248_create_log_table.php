<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table) {
            $table->id('id_log');
            $table->integer('id_identity_log');
            $table->integer('pertemuan_log')->default('0');
            $table->date('hari_log');
            $table->time('waktu_mulai_log');
            $table->time('waktu_selesai_log');
            $table->integer('id_ruang_log');
            $table->text('materi_log');
            $table->string('metode_pbm_log', 10);
            $table->integer('jumlah_mhs_hadir_log')->default('0');
            $table->string('qr_code_log', 100)->default(NULL);
            $table->tinyInteger('log_is_verif')->default('0');
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
        Schema::dropIfExists('log');
    }
}
