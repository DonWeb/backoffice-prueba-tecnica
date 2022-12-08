<?php

namespace App\Services;

class NameServersServices
{
    public function getNameServers($dominio)
    {
        $d = implode($dominio);
        $connection = fsockopen('whois.donweb.com', 43);
        fwrite($connection, $d);
        $data = [];
        while (!feof($connection)) {
            $data[] = fgets($connection, 4096);
        }
        fclose($connection);

        $ns = array_filter($data, static fn($item) => strpos($item, 'server:'));
        return $ns;
    }
}
