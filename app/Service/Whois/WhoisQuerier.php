<?php

namespace App\Service\Whois;

class WhoisQuerier
{
    private string $port = '43';

    private string $timeOut = '30';

    private $socket;

    /**
     * Make a query to the Whois server
     *
     * @param string $whoisServer
     * @param string $domainToQuery
     * @return string
     * @throws \ErrorException
     */
    public function queryServer(string $whoisServer, string $domainToQuery): string
    {
        $this->connectToServer($whoisServer);
        $this->writeDomain($domainToQuery);
        $response = $this->readResponse();
        $this->closeConnection();
        return $response;
    }

    /**
     * @param string $whoisServer
     * @return void
     * @throws \ErrorException
     */
    private function connectToServer(string $whoisServer): void
    {
        $this->socket = fsockopen("tcp://$whoisServer", $this->port, $errno, $errstr, $this->timeOut);
    }

    private function writeDomain(string $domainToQuery): void
    {
        fwrite($this->socket, $domainToQuery."\r\n");
    }

    private function readResponse(): string
    {
        $response = '';
        while(!feof($this->socket)) {
            $response .= fgets($this->socket, 1024);
        }
        return $response;
    }

    private function closeConnection(): void
    {
        fclose($this->socket);
    }
}