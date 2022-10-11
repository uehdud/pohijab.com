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
        Schema::create('resume_gudang_makkatas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('total_stok');
            $table->integer('id_warna');
            $table->integer('id_ukuran');
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
        Schema::dropIfExists('resume_gudang_makkatas');
    }
};
