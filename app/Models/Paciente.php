<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    // Especificar a tabela se necessário
    protected $table = 'pacientes';

    // Atributos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'datanascimento',
    ];

    protected $casts = [
        'datanascimento' => 'date',
    ];

    // App\Models\Paciente.php
    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class, 'idpaciente');
    }
}
