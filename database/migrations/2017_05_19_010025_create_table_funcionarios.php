<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFuncionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('func_cod');
            $table->string('func_imagem')->nullable();
            $table->string('func_nome');
            $table->string('func_CPF',14);      
            $table->string('func_RG',20);             
            $table->string('func_cartTrab');
            $table->string('func_cargo');  
            $table->date('func_dataNasc');
            $table->string('func_end_cidade');
            $table->string('func_end_estado');
            $table->string('func_end_bairro'); 
            $table->string('func_end_rua'); 
            $table->string('func_end_numero',12); 
            $table->string('func_end_complemento')->nullable(); 
            $table->string('func_end_logradouro'); 
            $table->string('func_email')->nullable();
            $table->string('func_telefone')->nullable();
            $table->string('func_telefoneCel')->nullable();
            $table->char('func_sexo',1);
            $table->integer('func_cargaHor');
            $table->integer('func_status')->default(1);
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
        Schema::dropIfExists('funcionarios');
    }
}
