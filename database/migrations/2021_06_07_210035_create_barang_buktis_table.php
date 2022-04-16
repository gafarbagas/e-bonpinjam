<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangBuktisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_buktis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('terdakwa_id');
            $table->integer('status_id');
            $table->string('kode_barangbukti')->unique();
            $table->string('nama_barangbukti');
            $table->foreign('terdakwa_id')->references('id')->on('terdakwas')->onDelete('cascade');
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
        Schema::dropIfExists('barang_buktis');
    }
}
