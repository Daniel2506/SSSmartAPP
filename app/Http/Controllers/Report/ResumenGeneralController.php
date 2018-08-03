<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Base\Finalized, App\Models\Base\Binnacle, App\Models\Base\Bills, App\Models\Base\Coin;
use DB, App, View, Excel;

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
            $machine =  $request->filled('machine_filter');

            // Recaudo
            $query = Finalized::query();
            $query->select(DB::raw('COUNT(*) as contador, SUM(finalizado_apagar) AS valor'));
            $query->where('finalizado_ffinal', '>=', $start_at);
            $query->where('finalizado_ffinal', '<=', $finish_at);
            $object->recaudo = $query->get()->toArray();

            // Aperturas x Administrador
            $query = Binnacle::query();
            $query->select(DB::raw('COUNT(*) as contador, SUM(bitacora_valor1) AS valor'));
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->where('bitacora_accion', 'AConsulta');
            $object->aperturas_con_pago = $query->get()->toArray();

            $query = Binnacle::query();
            $query->select(DB::raw('COUNT(*) as contador, SUM(bitacora_valor2) AS valor'));
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->where('bitacora_accion', 'AConsulta0');
            $object->aperturas_sin_pago = $query->get()->toArray();

            // Facturacion
            $query = Bills::query();
            $query->select(DB::raw('COUNT(id) as contador, SUM(factura_subtotal) AS subtotal, SUM(factura_iva) AS iva, SUM(factura_total) AS total'));
            $query->where('factura_fecha_emision', '>=', $request->start_at);
            $query->where('factura_fecha_emision', '<=', $request->finish_at);
            $object->facturacion = $query->get()->toArray();

            // Vaciado hopper
            $query = Binnacle::query();
            $query->select(DB::raw('SUM(bitacora_valor1) AS cuenta, SUM(bitacora_valor2) AS valor'), 'bitacora_accion', 'moneda_denominacion');
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->whereIn('bitacora_accion', ['Vaciar3', 'Vaciar4', 'Vaciar5', 'Vaciar6']);
            $query->leftJoin('monedas', 'moneda_canal', '=', DB::raw('SUBSTRING(bitacora_accion, -1, 1)'));
            $query->groupBy('bitacora_accion');
            $object->vaciado_hopper = $query->get()->toArray();

            // Recargas
            $query = Binnacle::query();
            $query->select(DB::raw('SUM(bitacora_valor1) AS cuenta, SUM(bitacora_valor2) AS valor'), 'bitacora_accion', 'moneda_denominacion');
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->whereIn('bitacora_accion', ['Recarga3', 'Recarga4', 'Recarga5', 'Recarga6']);
            $query->leftJoin('monedas', 'moneda_canal', '=', DB::raw('SUBSTRING(bitacora_accion, -1, 1)'));
            $query->groupBy('bitacora_accion');
            $object->recargas = $query->get()->toArray();

            // Rotacion
            $query = Bills::query();
            $query->select(DB::raw('COUNT(facturas.id) / maquina_casillas AS result'));
            $query->join('maquinas', 'factura_maquina', '=', 'maquinas.id');
            $query->where('factura_fecha_emision', '>=', $request->start_at);
            $query->where('factura_fecha_emision', '<=', $request->finish_at);
            $object->rotacion = $query->get()->toArray();

            // Vaciado cofre
            $query = Binnacle::query();
            $query->select(DB::raw('SUM(bitacora_valor1) AS cuenta, SUM(bitacora_valor2) AS valor'));
            $query->where('bitacora_fh', '>=', $start_at);
            $query->where('bitacora_fh', '<=', $finish_at);
            $query->where('bitacora_accion', 'Vcofre');
            $object->vaciado_cofre = $query->get()->toArray();

            // Rotacion diaria
            $query = Bills::query();
            $query->select(DB::raw("(COUNT(facturas.id) / maquina_casillas) as result"), 'factura_fecha_emision');
            $query->where('factura_fecha_emision', '>=', $request->start_at);
            $query->where('factura_fecha_emision', '<=', $request->finish_at);
            $query->join('maquinas', 'factura_maquina', '=', 'maquinas.id');
            $query->groupBy('factura_fecha_emision');
            $object->rotacion_diaria = $query->get();

            // Prepare report in Excel || Pdf
            $title = "Resumen general";
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
