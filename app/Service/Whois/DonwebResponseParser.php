<?php

namespace App\Service\Whois;

class DonwebResponseParser implements WhoisResponseParser
{
    public function parseResponse(string $responseContent): array
    {
        $responseLines =  array_map('trim', preg_split('/\n|\r\n?/', $responseContent));
        return $this->getNameServers($responseLines);
    }

    public function getNameServers(array $textLines): array
    {
        $nameServers = array_filter($textLines, function($el){
            return str_contains(strtolower($el), 'name server');
        });
        $nameServers =  str_replace('Name Server: ', '', $nameServers);
        return [ 'Name Servers' => array_values($nameServers) ];
    }
}