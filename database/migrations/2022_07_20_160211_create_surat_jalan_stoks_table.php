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
        Schema::create('surat_jalan_stoks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat_jalan');
            $table->integer('jumlah_produk');
            $table->date('tanggal_surat_jalan');
            $table->string('gudang_asal')->nullable();
            $table->string('gudang_tujuan')->nullable();
            $table->integer('status_inout')->nullable();
            $table->integer('status_kirim_sj')->nullable();
            $table->string('keterangan_surat_jalan')->nullable();
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
        Schema::dropIfExists('surat_jalan_stoks');
    }
};
