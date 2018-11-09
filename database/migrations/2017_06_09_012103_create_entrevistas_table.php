<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrevistasTable extends Migration
{
    public function up()
    {
     Schema::create('entrevistas', function (Blueprint $table) {
            $table->increments('ent_cod');
            $table->string('ent_entrevistado');
            $table->string('ent_entrevistador');
            $table->date('ent_data');     
            $table->string('ent_obs')->nullable();
            $table->string('ent_empresa');
            $table->string('ent_horario');
            $table->string('ent_end_cidade');
            $table->string('ent_end_estado');
            $table->string('ent_end_bairro'); 
            $table->string('ent_end_rua'); 
            $table->string('ent_end_numero',12); 
            $table->string('ent_end_complemento')->nullable(); 
            $table->string('ent_end_logradouro'); 
            $table->integer('ent_status')->default(1);
            $table->timestamps();          
         });
    }

    public function down()
    {
        Schema::dropIfExists('entrevistas');
        
    }
}
