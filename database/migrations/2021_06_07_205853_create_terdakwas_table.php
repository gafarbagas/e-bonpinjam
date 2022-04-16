<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerdakwasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terdakwas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_terdakwa')->unique();
            $table->UnsignedBigInteger('jaksa_id');
            $table->string('nik_terdakwa');
            $table->string('nama_terdakwa');
            $table->UnsignedBigInteger('keluarga_id');
            $table->string('orangtua_terdakwa');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->UnsignedBigInteger('agama_id');
            $table->string('tkp_desa');
            $table->string('tkp_kecamatan');
            $table->string('alamat_terdakwa');
            $table->string('pekerjaan_terdakwa');
            $table->UnsignedBigInteger('kewarganegaraan_id');
            $table->UnsignedBigInteger('pendidikan_id');
            $table->foreign('jaksa_id')->references('id')->on('jaksas');
            $table->foreign('keluarga_id')->references('id')->on('keluargas');
            $table->foreign('agama_id')->references('id')->on('agamas');
            $table->foreign('kewarganegaraan_id')->references('id')->on('kewarganegaraans');
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans');
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
        Schema::dropIfExists('terdakwas');
    }
}
