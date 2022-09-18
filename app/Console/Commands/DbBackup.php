<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a backup of the database';

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
        $filename = "database.sqlite." . Carbon::now()->format('Ymdhis') . ".backup";

        $createfile = "cp database/database.sqlite ".storage_path().'/app/backup/'.$filename;

        try {
            exec('mkdir '.storage_path().'/app/backup');
            copy("database/database.sqlite", storage_path().'/app/backup/'.$filename);
        } catch (\Throwable $th) {
            echo "ERROR: " . $th->getMessage();
            // En caso de error, aqui se podria configurar para enviar un correo electronico o agregar un log
        }
        return 0;
    }
}
