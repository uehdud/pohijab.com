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
        Schema::create('detail_produk_planets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('ukuran_ld')->nullable();
            $table->string('ukuran_pb')->nullable();
            $table->string('ukuran_lp')->nullable();
            $table->string('ukuran_lph')->nullable();
            $table->string('ukuran_pc')->nullable();
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
        Schema::dropIfExists('detail_produk_planets');
    }
};
