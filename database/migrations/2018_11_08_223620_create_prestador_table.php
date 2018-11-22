<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestadorTable extends Migration
{
    public function up()
    {
        Schema::create('prestador', function (Blueprint $table) {
            $table->increments('prestador_cod');
            $table->string('prestador_nome');
            $table->integer('prestador_vinculo');
            $table->string('prestador_tipo');
            $table->enum('prestador_representacao',['MEI', 'CNPJ']);
            $table->text('prestador_descricao'); 
            $table->integer('prestador_status')->default(1);
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
        Schema::dropIfExists('prestador');
    }
}
