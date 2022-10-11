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
        Schema::create('resume_stok_gudang_pusats', function (Blueprint $table) {
            $table->id();
            $table->string('no_po')->nullable();
            $table->string('kode_barang');
            $table->string('total_stok');
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
        Schema::dropIfExists('resume_stok_gudang_pusats');
    }
};
