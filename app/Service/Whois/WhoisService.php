<?php

namespace App\Service\Whois;

class WhoisService
{
    private WhoisQuerier $whoisQuerier;

    public function __construct(WhoisQuerier $whoisQuerier)
    {
        $this->whoisQuerier = $whoisQuerier;
    }
    public function makeQuery(string $whoisServer, string $domainToQuery): array
    {
        $response = $this->whoisQuerier->queryServer($whoisServer, $domainToQuery);
        $parser = ResponseParserFactory::getResponseParser($whoisServer);
        return $parser->parseResponse($response);
    }
}