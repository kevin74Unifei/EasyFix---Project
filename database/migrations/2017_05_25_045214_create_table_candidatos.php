<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCandidatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('candidatos', function (Blueprint $table) {
            $table->increments('cand_cod');
            $table->string('cand_imagem')->nullable();
            $table->string('cand_nome');
            $table->string('cand_CPF',14);          
            $table->date('cand_dataNasc');
            $table->string('cand_end_cidade');
            $table->string('cand_end_estado');
            $table->string('cand_end_bairro'); 
            $table->string('cand_end_rua'); 
            $table->string('cand_end_numero',12); 
            $table->string('cand_end_complemento')->nullable(); 
            $table->string('cand_end_logradouro'); 
            $table->string('cand_email');
            $table->string('cand_telefone')->nullable();
            $table->string('cand_telefoneCel')->nullable();
            $table->char('cand_sexo',1);
            $table->integer('cand_disponibilidade')->default(1);
            $table->integer('cand_status')->default(1);
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
