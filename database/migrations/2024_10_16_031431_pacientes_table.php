<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id(); // Coluna de ID auto-incrementável
            $table->string('nome'); // Nome do paciente
            $table->string('email')->unique(); // E-mail do paciente, deve ser único
            $table->string('telefone')->nullable(); // Telefone do paciente (pode ser nulo)
            $table->text('endereco')->nullable(); // Endereço do paciente (opcional)
            $table->date('datanascimento')->nullable(); // Data de nascimento do paciente (opcional)
            $table->timestamps(); // Colunas para created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes'); // Remove a tabela se existir
    }
};
