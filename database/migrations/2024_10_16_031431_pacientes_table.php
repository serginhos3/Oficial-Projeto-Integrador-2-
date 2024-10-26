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
            $table->string('nome', 255);
            $table->string('email', 255)->unique();
            $table->string('telefone', 13)->nullable();
            $table->string('cep', 8)->nullable();
            $table->string('logradouro', 255)->nullable(); 
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 255)->nullable(); 
            $table->string('bairro', 255)->nullable(); 
            $table->string('cidade', 255)->nullable(); 
            $table->string('estado', 2)->nullable();
            $table->date('datanascimento')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
