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
        Schema::create('cart_surat_jalans', function (Blueprint $table) {
            $table->id();
            $table->string('gudang_penerima');
            $table->date('tanggal_sj');
            $table->string('kode_barang');
            $table->integer('quantity');
            $table->integer('user_id');
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
        Schema::dropIfExists('cart_surat_jalans');
    }
};
