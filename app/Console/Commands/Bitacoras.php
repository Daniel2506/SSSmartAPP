<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Base\Binnacle, App\Models\Base\Machine;
use Log, DB;

class Bitacoras extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitacoras:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command store in table the bitacoras';

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
        Log::info('Iniciando rutina bitacoras:import');

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

                // Valido que archivo se de bitacora ('Bplano...pla')
                if (substr($name, 0, 2) === 'Bp') {
                    $handle = 'file.txt';

                    $file = ftp_get($connection, $handle, $path, FTP_ASCII, 0);

                    foreach (file($handle) as $line) {
                        list($user, $fecha_hora, $action, $value1, $value2, $observation) = explode('~', $line);
                        $exist = Binnacle::where('bitacora_fh', $fecha_hora)->first();
                        if (!$exist instanceof Binnacle) {
                            $bitacora = new Binnacle;
                            $bitacora->bitacora_maquina = $machine->id;
                            $bitacora->bitacora_usuario = $user;
                            $bitacora->bitacora_accion = $action;
                            $bitacora->bitacora_valor1 = $value1;
                            $bitacora->bitacora_valor2 = $value2;
                            $bitacora->bitacora_observaciones = $observation;
                            $bitacora->bitacora_fh = $fecha_hora;
                            $bitacora->save();
                        }
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

    /**
    * Set formating date apply save model
    *
    * @return date()
    */
    public function setDate($date)
    {
        $time = strtotime(str_replace('/','-', $date));
        return date('Y-m-d H:m:s', $time);
    }
}
