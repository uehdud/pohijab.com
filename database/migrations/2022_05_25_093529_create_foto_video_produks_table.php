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
        Schema::create('foto_video_produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('kode_model');
            $table->string('image_produk')->nullable();
            $table->string('image_comp')->nullable();
            $table->string('image_folder')->nullable();
            $table->string('video_produk')->nullable();
            $table->string('video_comp')->nullable();
            $table->string('ekstensi_combo')->nullable();
            $table->int('filesize_combo')->nullable();
            $table->string('ekstensi_video')->nullable();
            $table->int('filesize_video')->nullable();
            $table->int('user_upload')->nullable();
            $table->int('keterangan_foto')->nullable();
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
        Schema::dropIfExists('foto_video_produks');
    }
};
