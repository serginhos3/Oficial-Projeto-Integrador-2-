<?php

namespace App\Mail;

use App\Models\Orcamento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LembreteOrcamento extends Mailable
{
    use Queueable, SerializesModels;

    public $orcamento;

    public function __construct(Orcamento $orcamento)
    {
        $this->orcamento = $orcamento;
    }

    public function build()
    {
        return $this->subject('Lembrete de Orçamento')
                    ->view('emails.lembrete_orcamento'); // Crie a view correspondente
    }
}
