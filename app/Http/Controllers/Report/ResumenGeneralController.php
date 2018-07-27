<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

            //  Reference dates
            $start_at = "$request->start_at $request->start_at_time";
            $finish_at = "$request->finish_at $request->finish_at_time";

            // Recaudo

            // Aperturas x Administrador
            $sql = "
                SELECT  SUM(bitacora_valor1) AS valor
                FROM bitacoras
                WHERE   bitacora_fh >= '$start_at' AND
                        bitacora_fh <= '$finish_at' AND
                        bitacora_accion = 'AConsulta'
            ";

            $aperturas_con_pago = DB::select($sql);

            $sql = "
            SELECT  SUM(bitacora_valor2) AS valor
            FROM bitacoras
            WHERE   bitacora_fh >= '$start_at' AND
                    bitacora_fh <= '$finish_at' AND
                    bitacora_accion = 'AConsulta0'
            ";

            $aperturas_sin_pago = DB::select($sql);

            // Facturacion
            $sql = "
                SELECT  SUM(factura_subtotal) AS subtotal,
                        SUM(factura_iva) AS iva,
                        SUM(factura_total) AS total
                FROM facturas
                WHERE   factura_fecha_emision >= '$request->start_at' AND
                        factura_fecha_emision <= '$request->finish_at'
            ";

            $facturacion = DB::select($sql);

            // Vaciado hopper
            $sql ="
                SELECT  SUM(bitacora_valor1) AS cuenta,
                        SUM(bitacora_valor2) AS valor
                FROM bitacoras
                WHERE   bitacora_fh >= '$start_at' AND
                        bitacora_fh <= '$finish_at' AND
                        bitacora_accion IN ('Vaciar3', 'Vaciar4', 'Vaciar5', 'Vaciar6')
            ";

            $vaciado_hopper = DB::select($sql);

            // Recargas
            $sql ="
                SELECT  SUM(bitacora_valor1) AS cuenta,
                        SUM(bitacora_valor2) AS valor
                FROM bitacoras
                WHERE   bitacora_fh >= '$start_at' AND
                        bitacora_fh <= '$finish_at' AND
                        bitacora_accion IN ('Recarga3', 'Recarga4', 'Recarga5', 'Recarga6')
            ";

            $recargas =  DB::select($sql);

            // Rotacion
            $sql ="
                SELECT COUNT(f.id) / m.maquina_casillas AS result
                FROM facturas AS f, maquinas AS m
                WHERE   factura_fecha_emision >= '$request->start_at' AND
                        factura_fecha_emision <= '$request->finish_at'
            ";

            $rotacion = DB::select($sql);

            // Vaciado cofre
            $sql = "
                SELECT  SUM(bitacora_valor1) AS cuenta,
                        SUM(bitacora_valor2) AS valor
                FROM bitacoras
                WHERE   bitacora_fh >= '$start_at' AND
                        bitacora_fh <= '$finish_at' AND
                        bitacora_accion = 'Vcofre'
            ";

            $vaciado_cofre = DB::select($sql);

            // Prepare report in Excel || Pdf
            $title = "Resumen general";
            $type = $request->type;

            switch ($type) {
                case 'xls':
                    Excel::create(sprintf('%s_%s_%s', $title, date('Y_m_d'), date('H_m_s')), function($excel) use($title, $type) {
                        $excel->sheet('Excel', function($sheet) use($title, $type) {
                            $sheet->loadView('reports.resumengeneral.report', compact('title', 'type'));
                        });
                    })->download('xls');
                break;

                case 'pdf':
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadHTML(View::make('reports.resumengeneral.report',  compact('title', 'type'))->render());
                    $pdf->setPaper('letter', 'portrait')->setWarnings(false);
                    return $pdf->stream(sprintf('%s_%s_%s.pdf', $title, date('Y_m_d'), date('H_m_s')));
                break;
            }
        }
        return view('reports.resumengeneral.index');
    }
}
