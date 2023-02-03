<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class whois extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = "expiration:domain {domain}";

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = "Performs a whois data query through nic.ar's RDAP service and returns expiration date";

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $domain = $this->argument("domain");
    $codCountry = substr($domain, -3);
    if ($codCountry === ".ar") {
      $res = json_decode(file_get_contents("https://rdap.nic.ar/domain/" . $domain));
      echo date("d-m-Y", strtotime($res->events[1]->eventDate))."\n";
    } else echo "ERROR: only domains .ar \n";
  }
}
