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
        Schema::create('resume_pembagian_stok_pusats', function (Blueprint $table) {
            $table->id();
            $table->integer('no_po');
            $table->integer('kode_barang')->nullable();
            $table->integer('stok_po')->nullable();
            $table->integer('sisa_stok_po')->nullable();
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
        Schema::dropIfExists('resume_pembagian_stok_pusats');
    }
};
