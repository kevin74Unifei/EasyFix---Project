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
            $table->date('ent_data_inicial');     
            $table->date('ent_data_final');
            $table->string('ent_tipo_prof');
            $table->string('ent_status');
            $table->integer('ent_cod_pres');
            $table->integer('ent_cod_clie')->nullable();
            $table->timestamps();          
         });
    }

    public function down()
    {
        Schema::dropIfExists('entrevistas');
        
    }
}
