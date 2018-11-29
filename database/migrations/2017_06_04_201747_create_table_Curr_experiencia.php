<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCurrExperiencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CurrExperiencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curr_cod')->unsigned();
            $table->foreign('curr_cod')            
                    ->references('id')
                    ->on('curriculos')
                    ->onDelete('cascade');            
            $table->string('curr_nomeEmpresa');
            $table->string('curr_cargo');    
            $table->date('curr_dataInicioExp'); 
            $table->date('curr_dataSaidaExp');
            $table->string('curr_descExp');
            $table->integer('curr_active')->default(1);
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
        //
    }
}
