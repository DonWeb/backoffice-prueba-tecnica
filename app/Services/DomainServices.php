<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Iodev\Whois\Factory;

class DomainServices
{
    public static function domainExpired(string $domain): string
    {
        $response = Http::get("https://rdap.nic.ar/domain/{$domain}");

        if (self::domainAvailable($domain) && str_ends_with($domain, '.com.ar')) {
            $domainData = json_decode($response->getBody(), true);

            foreach ($domainData['events'] as $event) {
                if ($event['eventAction'] === 'expiration') {
                    return 'El dominio vence el día: '.Carbon::parse($event['eventDate'])->format('d-m-Y H:i:s');
                }
            }
        } else {
            return 'No podemos obtener información del dominio, puede que este disponible o hubo un error en la petición. Verifique!!!';
        }
    }

    private static function domainAvailable(string $domain)
    {
        $whois = Factory::get()->createWhois();
        $info = $whois->loadDomainInfo($domain);
        if (! $info) {
            return  false;
        }

        return  true;
    }
}
