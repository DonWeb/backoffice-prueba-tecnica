<?php

namespace App\Console\Commands;

use App\Service\RDPA\RDPAQuery;
use Illuminate\Console\Command;

class NicArWhoisCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nick-ar:whois {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query nick.ar whois for expiration date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(RDPAQuery $RDPAQuery)
    {
        try{
            $domain = $this->argument('domain');
            $expirationDate = $RDPAQuery->makeCall($domain);
            $this->line($expirationDate);
            return 0;
        } catch(\InvalidArgumentException $e){
            $this->line('Dominio inválido. Solo se permiten dominios .com.ar');
            return -1;
        } catch(\UnexpectedValueException $e){
            $this->line('Dominio no encontrado');
            return -1;
        }
    }
}
