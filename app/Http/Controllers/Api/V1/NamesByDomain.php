<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NamesByDomain extends Controller
{
  /**
   * Displays Name Servers fron domain
   *
   * @param  App\Http\Api\nameServer $request
   * @return \Illuminate\Http\Response
   */
  public function index($domain = null)
  {
    if ($domain) {
      $response = "Dominio: ".$domain."\r\n\r\n";
      $serverWois = "whois.donweb.com";
      $sock = fsockopen($serverWois, 43);
      if ($sock) {
        fwrite($sock, $domain . "\r\n");
        while (!feof($sock)) {
          $line = fgets($sock);
          if (substr($line, 0, 12) === "Name Server:")
            $response .= $line;
        }
        echo  "<pre>" . $response . "</pre>";
        fclose($sock);
      } else echo "Server not found...";
    } else echo "No domain to search";
  }
}
