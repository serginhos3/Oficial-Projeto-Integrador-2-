<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrcamentoAtrasado extends Mailable
{
    use Queueable, SerializesModels;

    public $orcamento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orcamento)
    {
        $this->orcamento = $orcamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Orçamento Em Aberto Há Mais de 30 Dias')
                    ->view('emails.orcamento_atrasado');
    }
}
