<?php

namespace App\Console\Commands;

use App\Models\Orcamento;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrcamentoAtrasado;
use Carbon\Carbon;

class OrcamentoStatus extends Command
{
    protected $signature = 'orcamento:status';

    protected $description = 'Listar orçamentos que estão em aberto há 30 dias ou mais';

    public function handle()
    {
        $dataLimite = Carbon::now()->subDays(30);

        $orcamentos = Orcamento::join('pacientes', 'pacientes.id', '=', 'orcamentos.idpaciente')
            ->whereNotIn('orcamentos.status', ['Concluído', 'Cancelado'])
            ->where('orcamentos.updated_at', '<=', $dataLimite)
            ->get();

        if ($orcamentos->isEmpty()) {
            $this->info("Nenhum orçamento em aberto há mais de 30 dias encontrado.");
            return;
        }

        foreach ($orcamentos as $orcamento) {
            Mail::to($orcamento->email)->send(new OrcamentoAtrasado($orcamento));
            $this->info("E-mail enviado para o orçamento ID: {$orcamento->id}");
        }
    }
}
