<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePagamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('pag_id');
            $table->integer('pag_empresa_cod')->unsigned();
            $table->foreign('pag_empresa_cod')
                    ->references('emp_cod')
                    ->on('empresas')
                    ->onDelete('cascade');
            $table->integer('pag_tipoPag');
            $table->double('pag_valorPag');    
            $table->string('pag_desconto');           
            $table->string('pag_valorTotal'); 
            $table->string('pag_situacao');
            $table->integer('pag_active')->default(1);
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
