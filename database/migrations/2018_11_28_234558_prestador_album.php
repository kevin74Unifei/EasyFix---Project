<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrestadorAlbum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestador_album', function (Blueprint $table) {
            $table->increments('album_id');
            $table->integer('prestador_id');
            $table->foreign('prestador_id')->references('prestador_cod')->on('prestador');
            $table->string('img_path');
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
        Schema::drop('prestador_album');
    }
}
