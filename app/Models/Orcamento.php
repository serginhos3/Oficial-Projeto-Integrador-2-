<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $table = 'orcamentos';

    protected $fillable = ['idpaciente', 'paciente', 'valor', 'procedimento', 'dentista', 'status', 'data'];

    protected $casts = [
        'data' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idpaciente');
    }
}
