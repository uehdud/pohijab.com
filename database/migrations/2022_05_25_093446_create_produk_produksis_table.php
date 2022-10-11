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
        Schema::create('produk_produksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->nullable();
            $table->string('nomor_po');
            $table->string('merk')->nullable();
            $table->string('kode_supp')->nullable();
            $table->string('nama_supp')->nullable();
            $table->string('kb')->nullable();
            $table->string('kode_model')->nullable();
            $table->string('harga_planet')->nullable();
            $table->string('harga_ta')->nullable();
            $table->string('kode_bahan')->nullable();
            $table->string('nama_bahan')->nullable();
            $table->integer('qty_seri')->nullable();
            $table->string('keterangan_po')->nullable();
            $table->string('user_input_po');
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
        Schema::dropIfExists('produk_produksis');
    }
};
