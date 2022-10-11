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
        Schema::create('pembagian_stok_pusats', function (Blueprint $table) {
            $table->id();
            $table->integer('no_po');
            $table->integer('kode_barang');
            $table->integer('jumlah_stok_pembagian');
            $table->integer('sisa_stok_po');
            $table->integer('toko_id');
            $table->string('keterangan_toko')->nullable();
            $table->string('user_pembagian');
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
        Schema::dropIfExists('pembagian_stok_pusats');
    }
};
