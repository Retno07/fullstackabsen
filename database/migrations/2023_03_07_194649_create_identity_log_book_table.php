<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityLogBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_log_book', function (Blueprint $table) {
            $table->id('id_identity');
            $table->integer('id_kelas_identity');
            $table->text('id_prodi_identity');
            $table->integer('jml_mhs');
            $table->text('id_makul_identity');
            $table->integer('id_makul_group');
            $table->integer('id_dosen_identity');
            $table->integer('id_akademik_identity');
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
        Schema::dropIfExists('identity_log_book');
    }
}
