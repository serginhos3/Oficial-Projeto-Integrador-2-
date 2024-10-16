<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    // Especificar a tabela se necessário
    protected $table = 'pacientes';

    // Atributos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',           // Nome do paciente
        'email',          // E-mail do paciente
        'telefone',       // Telefone do paciente
        'endereco',       // Endereço do paciente
        'datanascimento', // Data de nascimento do paciente
    ];

    // Se você precisar usar casts para formatação
    protected $casts = [
        'datanascimento' => 'date', // Garante que a data de nascimento seja tratada como uma data
    ];
}