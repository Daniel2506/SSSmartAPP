<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Base\Coin, App\Models\Base\Machine;
use Log, DB;

class Monedas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monedas:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command store in table the monedas';

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
        Log::info('Iniciando rutina monedas:import');

        // Establecer una conexión básica
        $connection = ftp_connect(config('koi.ftp.host'));

        // Iniciar sesión con nombre de usuario y contraseña
        ftp_login($connection, config('koi.ftp.user'), config('koi.ftp.password'));

        // Contenedor de archivos
        $paths = [];

        $directories = Machine::select('maquina_directorio')->get();
        foreach ($directories as $directory) {
            $paths = array_merge($paths, ftp_nlist($connection, $directory->maquina_directorio));
        }
        DB::beginTransaction();
        try {
            foreach ($paths as $path) {

                list($directory, $name) = explode('/', $path);

                $machine = Machine::where('maquina_directorio', $directory)->first();

                // Valido que archivo se de moneda ('Mplano...pla')
                if (substr($name, 0, 2) === 'Mp') {

                    $handle = 'file.txt';
                    $file = ftp_get($connection, $handle, $path, FTP_ASCII, 0);

                    foreach (file($handle) as $line) {

                        list($canal, $denominacion, $hopper) = explode('~', $line);

                        $coin = Coin::where('moneda_denominacion', $denominacion)->where('moneda_canal', $canal)->first();
                        if (!$coin instanceof Coin) {
                            $coin = new Coin;
                            $coin->moneda_maquina = $machine->id;
                            $coin->moneda_canal = $canal;
                            $coin->moneda_denominacion = $denominacion;
                        }
                        $coin->moneda_hopper = $hopper;
                        $coin->save();
                    }
                    unlink('file.txt');
                    ftp_delete($connection, $path);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            ftp_close ($connection);
            return;
        }
        ftp_close ($connection);
        Log::info('Rutina Ok');
    }
}
