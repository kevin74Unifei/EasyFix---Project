<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('cliente_cod');
            $table->string('cliente_imagem')->nullable();
            $table->string('cliente_nome');
            $table->string('cliente_CPF',14);
            $table->date('cliente_dataNasc');
            $table->string('cliente_end_cidade');
            $table->string('cliente_end_estado');
            $table->string('cliente_end_bairro'); 
            $table->string('cliente_end_rua'); 
            $table->string('cliente_end_numero',12); 
            $table->string('cliente_end_complemento')->nullable(); 
            $table->string('cliente_end_logradouro'); 
            $table->string('cliente_email');
            $table->string('cliente_telefone')->nullable();
            $table->string('cliente_telefoneCel')->nullable();
            $table->char('cliente_sexo',1);
            $table->integer('cliente_status')->default(1);
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
        Schema::dropIfExists('clientes');
    }
}
