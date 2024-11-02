<?php

namespace App\Console\Commands;

use App\Mail\OrcamentoAtrasado;
use App\Models\Orcamento;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class OrcamentoCancelar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orcamento:cancelar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        echo "executando";
        $dataLimite = Carbon::now()->subDays(90);
        $orcamentos = Orcamento::where('status', '<>', 'Concluído')
            ->where('updated_at', '<=', $dataLimite)
            ->get();

        if ($orcamentos->isEmpty()) {
            $this->info("Nenhum orçamento encontrado com status diferente de 'Concluído' e atualizado há mais de 90 dias.");
            return;
        }

        foreach ($orcamentos as $orcamento) {
            Orcamento::where('id', $orcamento->id)->update(["status" => "Cancelado"]);
        }
    }
}
