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
        Schema::create('detail_foto_videos', function (Blueprint $table) {
            $table->id();
            $table->string('fotovideo_produk_id');
            $table->string('imagevideo_detail')->nullable();
            $table->int('user_upload_detail')->nullable();
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
        Schema::dropIfExists('detail_foto_videos');
    }
};
