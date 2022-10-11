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
        Schema::create('detailproduks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_barang');
            $table->integer('qty_terima');
            $table->integer('status_id');
            $table->integer('gudang_id');
            $table->string('image_name')->nullable();
            $table->string('video_name')->nullable();
            $table->string('user_upload')->nullable();
            $table->string('no_surat_jalan')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('detailproduks');
    }
};
