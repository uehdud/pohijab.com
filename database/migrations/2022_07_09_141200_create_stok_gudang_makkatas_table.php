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
        Schema::create('stok_gudang_makkatas', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat_jalan');
            $table->string('kode_barang');
            $table->string('no_po');
            $table->integer('id_warna');
            $table->integer('id_ukuran');
            $table->string('qty');
            $table->string('status_inout');
            $table->string('keterangan_inout');
            $table->integer('user_input');
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
        Schema::dropIfExists('stok_gudang_makkatas');
    }
};
