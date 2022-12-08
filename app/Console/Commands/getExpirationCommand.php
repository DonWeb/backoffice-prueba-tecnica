<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class getExpirationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dominio:vencimiento {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commando para consultar por el vencimiento de un dominio .com.ar';


    /**
     * Execute the console command.
     * @return void|null
     */
    public function handle()
    {
        $rdapUrl = config('services.api.rdap');

        $isValid = $this->validarDominio($this->argument('url'));


        if($isValid) {
            $response = Http::get( $rdapUrl . $this->argument('url'));

            $event = $response->collect('events')->toArray();

            $expiration = $this->getExpiration($event);

            $date = Carbon::parse($expiration)->format('d-m-y');

            return $this->info("El vencimiento del dominio es ${date}");

        }
        return $this->warn('Se debe ingresar un dominio .com.ar valido');
    }

    private function getExpiration($data)
    {
         $filter = array_filter($data, static function ($item) {
            return $item['eventAction'] === 'expiration' ;
        });

         return Arr::get($filter, '1.eventDate');
    }

    private function validarDominio(bool|array|string|null $argument): string
    {
        return is_string($argument) && Str::contains($argument, 'com.ar');
    }
}
