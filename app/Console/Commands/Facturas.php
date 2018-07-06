<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Base\Bills;
use Storage, Log, DB;

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
        $path = "storage/app/plano201873.txt";
        DB::beginTransaction();
        try {
            foreach (file($path) as $line) {
                list($numero, $prefijo, $f_emision, $f_inicio, $f_final, $casilla, $subtotal, $p_iva, $iva, $total, $pago, $cambio, $time) = explode('|', $line);
                $bill = new Bills;
                $bill->factura_numero =  $numero;
                $bill->factura_prefijo = $prefijo;
                $bill->factura_fecha_emision = $f_emision;
                $bill->factura_fh_inicio = $f_inicio;
                $bill->factura_fh_final = $f_final;
                $bill->factura_casilla = $casilla;
                $bill->factura_subtotal = $subtotal;
                $bill->factura_iva_p = $p_iva;
                $bill->factura_iva = $iva;
                $bill->factura_total = $total;
                $bill->factura_pago = $pago;
                $bill->factura_cambio = $cambio;
                $bill->factura_tiempo = $time;
                $bill->save();
                Log::info($bill->factura_fh_final);
            }
            DB::commit();
            Log::info('Rutina Ok');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
        }
    }
}
