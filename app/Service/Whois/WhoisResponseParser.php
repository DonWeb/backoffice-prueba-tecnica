<?php

namespace App\Service\Whois;

interface WhoisResponseParser
{
    public function parseResponse(string $content): array;
}