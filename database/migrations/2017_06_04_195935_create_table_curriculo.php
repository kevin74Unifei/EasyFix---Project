<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCurriculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cand_cod')->unsigned();
            $table->foreign('cand_cod')            
                    ->references('cand_cod')
                    ->on('candidatos')
                    ->onDelete('cascade');
            $table->morphs('curr_obj');
            $table->string('curr_idiomas');
            $table->string('curr_extra',254)->nullable();    
            $table->date('curr_dataEmit');   
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
