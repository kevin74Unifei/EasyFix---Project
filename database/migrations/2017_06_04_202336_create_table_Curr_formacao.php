<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCurrFormacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CurrFormacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curr_cod')->unsigned();
            $table->foreign('curr_cod')            
                    ->references('id')
                    ->on('curriculos')
                    ->onDelete('cascade');            
            $table->string('curr_nomeInst');
            $table->string('curr_curso');    
            $table->string('curr_situacaoCurso'); 
            $table->date('curr_dataForm');            
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
