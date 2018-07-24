<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Base\Bills;
use Log, DB, Storage;

class Facturas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facturas:import';

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
        Log::info('Iniciando rutina facturas:import');

        // Establecer una conexión básica
        $connection = ftp_connect(config('koi.ftp.host'));

        // Iniciar sesión con nombre de usuario y contraseña
        ftp_login($connection, config('koi.ftp.user'), config('koi.ftp.password'));

        // Contenedor de archivos
        $paths = [];

        $directories = DB::table('maquinas')->select('maquina_directorio')->get();
        foreach ($directories as $directory) {
            $paths = array_merge($paths, ftp_nlist($connection, $directory->maquina_directorio));
        }
        DB::beginTransaction();
        try {
            foreach ($paths as $path) {

                list($directory, $name) = explode('/', $path);

                // Valido que archivo se de factura ('Fplano...txt')
                if (substr($name, 0, 1) === 'F') {
                    $handle = 'file.txt';
                    $file = ftp_get($connection, $handle, $path, FTP_ASCII, 0);

                    foreach (file($handle) as $line) {
                        list($numero, $prefijo, $f_emision, $f_inicio, $f_final, $casilla, $subtotal, $p_iva, $iva, $total, $pago, $cambio, $time) = explode('|', $line);

                        $exist = Bills::where('factura_numero', $numero)->where('factura_prefijo', $prefijo)->first();
                        if (!$exist instanceof Bills) {
                            $bill = new Bills;
                            $bill->factura_maquina =  1;
                            $bill->factura_numero =  $numero;
                            $bill->factura_prefijo = $prefijo;
                            $bill->factura_fecha_emision = $this->setDate($f_emision);
                            $bill->factura_fh_inicio = $this->setDate($f_inicio);
                            $bill->factura_fh_final = $this->setDate($f_final);
                            $bill->factura_casilla = $casilla;
                            $bill->factura_subtotal = $subtotal;
                            $bill->factura_iva_p = $p_iva;
                            $bill->factura_iva = $iva;
                            $bill->factura_total = $total;
                            $bill->factura_pago = $pago;
                            $bill->factura_cambio = $cambio;
                            $bill->factura_tiempo = $time;
                            $bill->save();
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
