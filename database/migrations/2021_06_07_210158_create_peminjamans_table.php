<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_peminjaman')->unique();
            $table->string('nama_peminjam');
            $table->string('nik_peminjam');
            $table->UnsignedBigInteger('masyarakat_id')->nullable();
            $table->foreign('masyarakat_id')->references('id')->on('masyarakats');
            $table->date('tgl_peminjaman');
            $table->date('tgl_akhir');
            $table->string('alamat_peminjam');
            $table->UnsignedBigInteger('terdakwa_id');
            $table->foreign('terdakwa_id')->references('id')->on('terdakwas');
            $table->integer('status_peminjaman_id')->default(1);
            $table->string('keterangan_peminjaman')->nullable();
            $table->string('foto_ktp_peminjam')->nullable();
            $table->timestamp('tgl_konfirmasi_admin')->nullable();
            $table->string('persetujuan_admin')->nullable();
            $table->timestamp('tgl_konfirmasi_jaksa')->nullable();
            $table->string('persetujuan_jaksa')->nullable();
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
        Schema::dropIfExists('peminjamans');
    }
}
