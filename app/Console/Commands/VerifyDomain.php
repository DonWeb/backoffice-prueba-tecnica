<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class VerifyDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:verify {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify date of expiration of domain';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domain = $this->argument('domain');

        $res = Http::get('https://rdap.nic.ar/domain/'.$domain);

        if ($res->getStatusCode() == 200) {
            $response_data = $res->object();
        }else{
            $response_data = "Error: " . $res->getStatusCode();
        }

        echo date('Y-m-d h:i:s', strtotime($response_data->events[1]->eventDate));

        return 0;
    }
}
