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
        Schema::create('kontrol_stoks', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_inout');
            $table->string('tujuan');
            $table->string('no_sj');
            $table->string('tanggal_sj');
            $table->string('qty');
            $table->string('keterangan_sj')->nullable();
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
        Schema::dropIfExists('kontrol_stoks');
    }
};
