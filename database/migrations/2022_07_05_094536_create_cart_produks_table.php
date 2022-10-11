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
        Schema::create('cart_produks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_input_cart');
            $table->integer('kode_barang');
            $table->integer('kategori');
            $table->integer('quantity');
            $table->integer('id_warna');
            $table->integer('id_ukuran');
            $table->string('jenis_inout');
            $table->string('status_inout');
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
        Schema::dropIfExists('cart_produks');
    }
};
