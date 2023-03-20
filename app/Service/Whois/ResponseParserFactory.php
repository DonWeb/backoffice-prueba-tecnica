<?php

namespace App\Service\Whois;
use Ramsey\Collection\Exception\UnsupportedOperationException;

class ResponseParserFactory
{
    public static function getResponseParser($whoisServer): WhoisResponseParser
    {
        if($whoisServer == 'whois.donweb.com'){
            return new DonwebResponseParser;
        }
        throw new UnsupportedOperationException('Parser no encontrado');
    } 
}