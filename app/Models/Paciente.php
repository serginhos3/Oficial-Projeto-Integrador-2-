<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';


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

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class, 'idpaciente');
    }
}
