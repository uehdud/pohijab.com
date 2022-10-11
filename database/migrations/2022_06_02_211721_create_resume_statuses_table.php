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
        Schema::create('resume_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->integer('status_id');
            $table->integer('gudang_id')->nullable();
            $table->integer('total_stok')->nullable();
            $table->integer('user_update')->nullable();
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
        Schema::dropIfExists('resume_statuses');
    }
};
