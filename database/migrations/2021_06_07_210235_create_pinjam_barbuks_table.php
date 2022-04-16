<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamBarbuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_barbuks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('peminjaman_id');
            $table->unsignedBigInteger('barang_bukti_id');
            $table->foreign('peminjaman_id')->references('id')->on('peminjamans')->onDelete('cascade');
            $table->foreign('barang_bukti_id')->references('id')->on('barang_buktis')->onDelete('cascade');
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
        Schema::dropIfExists('pinjam_barbuks');
    }
}
