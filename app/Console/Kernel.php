<?php

namespace App\Console;

use App\Mail\LembreteOrcamento;
use App\Models\Orcamento;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;


class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // Aqui você pode buscar orçamentos e enviar e-mails
            $orcamentos = Orcamento::where('status', 'em aberto')->get(); // Ajuste a consulta conforme necessário

            foreach ($orcamentos as $orcamento) {
                Mail::to($orcamento->email) // Certifique-se de que o e-mail está na tabela de orçamentos
                    ->send(new LembreteOrcamento($orcamento));
            }
        })->daily(); // Altere a frequência conforme necessário
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
