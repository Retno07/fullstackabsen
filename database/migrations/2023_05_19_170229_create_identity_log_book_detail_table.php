<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityLogBookDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_log_book_detail', function (Blueprint $table) {
            $table->id('id_identity_detail');
            $table->integer('id_identity_logbook');
            $table->bigInteger('id_mhs_identity');
            $table->text('nama_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity_log_book_detail');
    }
}
