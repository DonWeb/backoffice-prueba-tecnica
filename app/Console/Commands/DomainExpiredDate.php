<?php

namespace App\Console\Commands;

use App\Services\DomainServices;
use Illuminate\Console\Command;
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
        $dateExpired = DomainServices::domainExpired($this->option('domain'));
        $output->writeln("\n<info> {$dateExpired} </info>");
    }
}
