<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJaksasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jaksas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nrp_jaksa')->unique();
            $table->string('nama_jaksa');
            $table->string('jabatan');
            $table->string('pangkat');
            $table->UnsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('jaksas');
    }
}
