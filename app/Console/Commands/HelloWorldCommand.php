<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HelloWorldCommand extends Command
{
    /**
     * O nome e assinatura do comando no console.
     *
     * @var string
     */
    protected $signature = 'hello:world';

    /**
     * A descrição do comando.
     *
     * @var string
     */
    protected $description = 'Imprime Hello, World! no terminal';

    /**
     * Executa o comando.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Hello, Worldsasasasa!');
        return 0;
    }
}
