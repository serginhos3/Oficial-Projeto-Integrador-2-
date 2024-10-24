<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->text('cep')->nullable(); 
            $table->text('logradouro')->nullable(); 
            $table->text('numero')->nullable(); 
            $table->text('complemento')->nullable(); 
            $table->text('bairro')->nullable(); 
            $table->text('cidade')->nullable(); 
            $table->text('estado')->nullable(); 
            $table->date('datanascimento')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
