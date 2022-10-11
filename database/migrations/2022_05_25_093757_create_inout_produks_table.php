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
        Schema::create('inout_produks', function (Blueprint $table) {
            $table->id();
            $table->integer('surat_jalan_id')->nullable();
            $table->string('kode_barang');
            $table->string('qty_inout');
            $table->integer('gudang_asal')->nullable();
            $table->integer('gudang_tujuan')->nullable();
            $table->integer('qty_total')->nullable();
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
        Schema::dropIfExists('inout_produks');
    }
};
