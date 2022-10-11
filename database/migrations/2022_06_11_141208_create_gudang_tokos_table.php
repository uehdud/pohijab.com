<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudang_tokos', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_barang');
            $table->integer('stok_toko')->nullable();
            $table->string('toko_id');
            $table->string('nama_toko');
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
        Schema::dropIfExists('gudang_tokos');
    }
};
