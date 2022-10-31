<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput as ConsoleOutput;

class DomainExpiredDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:expired {--domain=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtains the expiration date of a domain';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $output = new ConsoleOutput();
        $output->writeln("<comment>Fecha de vencimiento del dominio</comment>\n");
        $response = Http::get("https://rdap.nic.ar/domain/{$this->option('domain')}");

        $output->writeln("\n<info> El dominio vence el día: {$response->body()} </info>");
    }
}
