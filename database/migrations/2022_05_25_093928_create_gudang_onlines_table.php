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
        Schema::create('gudang_onlines', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat_jalan');
            $table->integer('no_po')->nullable();
            $table->integer('kode_barang');
            $table->integer('quantity');
            $table->integer('status_produk');
            $table->string('keterangan_inout')->nullable();
            $table->integer('user_input_stok_online');
            $table->date('tanggal_inout')->nullable();
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
        Schema::dropIfExists('gudang_onlines');
    }
};
