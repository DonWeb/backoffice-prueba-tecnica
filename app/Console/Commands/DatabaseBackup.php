<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use ZipArchive;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create copy of mysql dump for existing database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = env('DB_DATABASE').'-'.Carbon::now()->format('Y-m-d').'.sql';
        $directorioBackup = storage_path().'/app/backup/'.$filename;
        $command = 'mysqldump -h'.env('DB_HOST').' -u'.env('DB_USERNAME').' --opt '.env('DB_DATABASE').' > '.$directorioBackup;
        system($command, $output);

        $zip = new ZipArchive();

        $salida_zip = env('DB_DATABASE').'_database_'.now()->format('Y-m-d').'.zip';

        if ($zip->open($salida_zip, ZIPARCHIVE::CREATE) === true) {
            $zip->addGlob($directorioBackup);
            $zip->close();
            unlink($directorioBackup);
        } else {
            echo 'Error'; //Enviamos el mensaje de error
        }
    }
}
