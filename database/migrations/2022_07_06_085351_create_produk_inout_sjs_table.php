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
        Schema::create('produk_inout_sjs', function (Blueprint $table) {
            $table->id();
            $table->integer('no_sj');
            $table->string('kode_barang');
            $table->integer('id_warna');
            $table->integer('id_ukuran');
            $table->integer('qty_produk');
            $table->string('status_kirim');
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
        Schema::dropIfExists('produk_inout_sjs');
    }
};
