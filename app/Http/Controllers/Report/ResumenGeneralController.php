<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Base\Finalized, App\Models\Base\Binnacle, App\Models\Base\Bills, App\Models\Base\Coin, App\Models\Base\CoinCasket, App\Models\Base\Machine;
use DB, App, View, Excel, Validator;

class ResumenGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('type')) {

            // Instance global object
            $object = new \stdClass();

            //  Reference dates
            $start_at = "$request->start_at $request->start_at_time";
            $finish_at = "$request->finish_at $request->finish_at_time";
            $filter_machine =  $request->filled('machine_filter');

            $validator = Validator::make($request->all(), [
                'finish_at' => 'required',
                'finish_at' => 'required',
            ]);

            // Validar que sean requeridos
            if ($validator->fails()) {
                return redirect('/resumengeneral')
                ->withErrors($validator)
                ->withInput();
            }

            // Validar maquina
            if ($filter_machine) {
                $machine = Machine::find($request->machine_filter);
                if (!$machine  instanceof Machine) {
                    return redirect('/resumengeneral')->withErrors('No es posible recuperar máquina con la cual quiere filtrar el reporte')->withInput();
                }
            }

            // Recaudo
            $query = Finalized::query();
            $query->select(DB::raw('COUNT(*) as contador, SUM(finalizado_apagar) AS valor'));
            $query->where('finalizado_ffinal', '>=', $start_at);
            $query->where('finalizado_ffinal', '<=', $finish_at);
            !$filter_machine ?: $query->where('finalizado_maquina', $request->machine_filter);

            $object->recaudo = $query->get()->toArray();

            // Aperturas x Administrador
            $query = Binnacle::query();
            $query->select(DB::raw('COUNT(*) as contador, SUM(bitacora_valor1) AS valor'));
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->where('bitacora_accion', 'AConsulta');
            !$filter_machine ?: $query->where('bitacora_maquina', $request->machine_filter);

            $object->aperturas_con_pago = $query->get()->toArray();

            $query = Binnacle::query();
            $query->select(DB::raw('COUNT(*) as contador, SUM(bitacora_valor2) AS valor'));
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->where('bitacora_accion', 'AConsulta0');
            !$filter_machine ?: $query->where('bitacora_maquina', $request->machine_filter);

            $object->aperturas_sin_pago = $query->get()->toArray();

            // Facturacion
            $query = Bills::query();
            $query->select(DB::raw('COUNT(id) as contador, SUM(factura_subtotal) AS subtotal, SUM(factura_iva) AS iva, SUM(factura_total) AS total'));
            $query->where('factura_fecha_emision', '>=', $request->start_at);
            $query->where('factura_fecha_emision', '<=', $request->finish_at);
            !$filter_machine ?: $query->where('factura_maquina', $request->machine_filter);

            $object->facturacion = $query->get()->toArray();

            // Vaciado hopper
            $query = Binnacle::query();
            $query->select(DB::raw('SUM(bitacora_valor1) AS cuenta, SUM(bitacora_valor2) AS valor'), 'bitacora_accion', 'moneda_denominacion');
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->whereIn('bitacora_accion', ['Vaciar3', 'Vaciar4', 'Vaciar5', 'Vaciar6']);
            $query->leftJoin('monedas', 'moneda_canal', '=', DB::raw('SUBSTRING(bitacora_accion, -1, 1)'));
            !$filter_machine ?: $query->where('bitacora_maquina', $request->machine_filter);
            $query->groupBy('bitacora_accion');

            $object->vaciado_hopper = $query->get()->toArray();

            // Recargas
            $query = Binnacle::query();
            $query->select(DB::raw('SUM(bitacora_valor1) AS cuenta, SUM(bitacora_valor2) AS valor'), 'bitacora_accion', 'moneda_denominacion');
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->whereIn('bitacora_accion', ['Recarga3', 'Recarga4', 'Recarga5', 'Recarga6']);
            $query->leftJoin('monedas', 'moneda_canal', '=', DB::raw('SUBSTRING(bitacora_accion, -1, 1)'));
            !$filter_machine ?: $query->where('bitacora_maquina', $request->machine_filter);
            $query->groupBy('bitacora_accion');

            $object->recargas = $query->get()->toArray();

            // Rotacion
            $query = Bills::query();
            $query->select(DB::raw('COUNT(facturas.id) / maquina_casillas AS result'));
            $query->join('maquinas', 'factura_maquina', '=', 'maquinas.id');
            $query->where('factura_fecha_emision', '>=', $request->start_at);
            $query->where('factura_fecha_emision', '<=', $request->finish_at);
            !$filter_machine ?: $query->where('factura_maquina', $request->machine_filter);

            $object->rotacion = $query->get()->toArray();

            // Vaciado cofre
            $query = Binnacle::query();
            $query->select(DB::raw('SUM(bitacora_valor1) AS cuenta, SUM(bitacora_valor2) AS valor'));
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->where('bitacora_accion', 'Vcofre');
            !$filter_machine ?: $query->where('bitacora_maquina', $request->machine_filter);

            $object->vaciado_cofre = $query->get()->toArray();

            /*Saldos actuales*/
            // Hoppers
            $query = Coin::query();
            $query->select('monedas.*', DB::raw('SUM(moneda_denominacion * moneda_hopper) AS valor'));
            !$filter_machine ?: $query->where('moneda_maquina', $request->machine_filter);
            $query->groupBy('moneda_denominacion');

            $object->saldo_hopper = $query->get();

            // Cofres
            $query = CoinCasket::query();
            $query->select('coins.*', DB::raw('SUM(coin_denominacion * coin_cofre) AS valor'));
            !$filter_machine ?: $query->where('coin_maquina', $request->machine_filter);
            $query->groupBy('coin_canal');

            $object->saldo_cofre = $query->get();

            // Rotacion diaria
            $query = Bills::query();
            $query->select(DB::raw("(COUNT(facturas.id) / maquina_casillas) as result, DATE_FORMAT(factura_fecha_emision, '%w') AS day"), 'factura_fecha_emision');
            $query->where('factura_fecha_emision', '>=', $request->start_at);
            $query->where('factura_fecha_emision', '<=', $request->finish_at);
            $query->join('maquinas', 'factura_maquina', '=', 'maquinas.id');
            !$filter_machine ?: $query->where('factura_maquina', $request->machine_filter);
            $query->groupBy('factura_fecha_emision');

            $object->rotacion_diaria = $query->get();

            // Prepare report in Excel || Pdf
            $title = $filter_machine ? "Resumen General de la máquina $machine->maquina_serie" : "Resumen general";
            $type = $request->type;

            switch ($type) {
                case 'xls':
                    Excel::create(sprintf('%s_%s_%s', $title, date('Y_m_d'), date('H_m_s')), function($excel) use($title, $type, $request, $object) {
                        $excel->sheet('Excel', function($sheet) use($title, $type, $request, $object) {
                            $sheet->loadView('reports.resumengeneral.report', compact('title', 'type', 'request', 'object'));
                        });
                    })->download('xls');
                break;

                case 'pdf':
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadHTML(View::make('reports.resumengeneral.report',  compact('title', 'type', 'request', 'object'))->render());
                    $pdf->setPaper('letter', 'portrait')->setWarnings(false);
                    return $pdf->stream(sprintf('%s_%s_%s.pdf', $title, date('Y_m_d'), date('H_m_s')));
                break;
            }
        }
        return view('reports.resumengeneral.index');
    }
}
