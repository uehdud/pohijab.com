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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nopo');
            $table->string('kode_barang');
            $table->string('qty_seri');
            $table->string('harga_ta');
            $table->string('harga_planet');
            $table->string('nama_bahan');
            $table->string('kode_bahan');
            $table->string('merk');
            $table->string('kode_model');
            $table->string('kode_supp');
            $table->string('nama_supp');
            $table->string('user_pengirim')->nullable();
            $table->date('tanggal_kirim')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('produks');
    }
};
