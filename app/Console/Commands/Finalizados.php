<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Base\Finalized, App\Models\Base\Machine;
use Log, DB;

class Finalizados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'finalizados:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Log::info('Iniciando rutina finalizados:import');

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

                // Valido que archivo se de finalizados ('Fiplano...pla')
                if (substr($name, 0, 3) === 'Fip') {
                    $handle = 'file.txt';
                    $file = ftp_get($connection, $handle, $path, FTP_ASCII, 0);

                    foreach (file($handle) as $line) {

                        list($casilla, $start_at, $finish_at, $time, $pago, $ingreso, $cambio) = explode('~', $line);
                        $exist = Finalized::where('finalizado_casilla', $casilla)->where('finalizado_finicio', $start_at)->first();

                        if (!$exist instanceof Finalized) {
                            $finalized = new Finalized;
                            $finalized->finalizado_maquina =  $machine->id;
                            $finalized->finalizado_casilla =  $casilla;
                            $finalized->finalizado_finicio = $start_at;
                            $finalized->finalizado_ffinal = $finish_at;
                            $finalized->finalizado_tiempo = $time;
                            $finalized->finalizado_apagar = $pago;
                            $finalized->finalizado_ingreso = $ingreso;
                            $finalized->finalizado_cambio = $cambio;
                            $finalized->save();
                        }
                    }
                    unlink('file.txt');
                    // ftp_delete($connection, $path);
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

    /**
    * Set formating date apply save model
    * Format in file generated error
    * @return date()
    */
    public function setDate($date)
    {
        $time = strtotime(str_replace('/','-', $date), 1);
        dd(date('Y-m-d H:m:s'));
        return date('Y-m-d H:m:s');
    }
}
