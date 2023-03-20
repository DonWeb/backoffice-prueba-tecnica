<?php

namespace App\Service\RDPA;

use Illuminate\Support\Facades\Http;

class RDPAQuery
{
    /**
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException 
     */
    public function makeCall(string $domain): string
    {
        if(!str_ends_with($domain, 'com.ar')){
            throw new \InvalidArgumentException('Dominio inválido. Solo se permiten dominios .com.ar');
        }
        $domainEvents = $this->callRDPAForDomainEvents($domain);
        return $this->getExpirationDate($domainEvents);
    }

    /**
     * @throws \UnexpectedValueException
     */
    public function callRDPAForDomainEvents(string $domain): array
    {
        $response = Http::get("https://rdap.nic.ar/domain/$domain");
        $domainEvents = $response->json('events');
        if(!is_array($domainEvents) || count($domainEvents) == 0){
            throw new \UnexpectedValueException('Dominio no encontrado');
        }
        return $domainEvents;
    }

    private function getExpirationDate(array $domainEvents): string
    {
        $expirationDate = '';
        foreach($domainEvents as $event){
            if($event['eventAction'] == 'expiration'){
                $expirationDate = (new \DateTime($event['eventDate']))->format('h:i:s d/M/Y');
            }
        }
        return $expirationDate;
    }
}