<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class PutFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archivos:put';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put ftp archivos testing Facturas y Bitacoras';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Storage::files('test') as $path) {
            $file = Storage::get($path);
            Storage::disk('ftp')->copy($path, $file);
        }
    }
}
