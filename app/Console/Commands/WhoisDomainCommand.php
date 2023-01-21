<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class WhoisDomainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:whois {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consulta de datos de Whois por medio del servicio de nic.ar';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domain = $this->argument('domain');
        $response = Http::get('https://rdap.nic.ar/domain/'.$domain);
        $data=json_decode($response)->events;
        print_r($data[1]);
    }
}
