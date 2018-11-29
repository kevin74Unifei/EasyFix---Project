<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('emp_cod');
            $table->string('emp_nome');
            $table->string('emp_razao');
            $table->string('emp_CNPJ',18);      
            $table->string('emp_inscricaEst',15);           
            $table->string('emp_end_cidade');
            $table->string('emp_end_estado');
            $table->string('emp_end_bairro'); 
            $table->string('emp_end_rua'); 
            $table->string('emp_end_numero',12); 
            $table->string('emp_end_complemento')->nullable(); 
            $table->string('emp_end_logradouro'); 
            $table->string('emp_email');
            $table->string('emp_telefone');
            $table->string('emp_telefoneCel')->nullable();
            $table->integer('emp_status')->default(1);
            $table->timestamps();          
         });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
        
    }
}
