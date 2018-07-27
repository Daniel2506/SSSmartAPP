<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.main');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function charts(Request $request)
    {
        if ($request->ajax()) {

            // Meses & dias en español
            DB::statement('SET lc_time_names = es_ES');

            // Instance global object
            $object = new \stdClass();
            $object->success = true;
            $object->chart_rotacion_dia = [];
            $object->chart_rotacion_smeses = [];
            $object->chart_comisones_maquinas = [];

            // Rotacion X dia
            $rotacion_dia = new \stdClass();
            $rotacion_dia->labels = [];
            $rotacion_dia->data = [];

            // Prepare query
            $sql = "
                SELECT (COUNT(f.id) / m.maquina_casillas) as result, DATE_FORMAT(f.factura_fecha_emision, '%w') AS day, DATE_FORMAT(f.factura_fecha_emision, '%W') AS day_letters
                FROM facturas as f, maquinas as m WHERE f.factura_fecha_emision > DATE_SUB(DATE(NOW()), INTERVAL 8 DAY) AND f.factura_fecha_emision <= DATE(NOW())
                GROUP BY f.factura_fecha_emision ORDER BY DATE_FORMAT(DATE(NOW()), '%w')";

            // Execute sql
            $query = DB::select($sql);

            // Config chart rotacion X dia
            $rotacion_dia->labels = array_pluck($query, 'day_letters');
            $rotacion_dia->data = array_pluck($query, 'result');

            // Rotacion ultimos 6 meses
            $rotacion_smeses = new \stdClass();
            $rotacion_smeses->labels = [];
            $rotacion_smeses->data = [];

            // Prepare query
            $sql = "
                SELECT (COUNT(f.id) / m.maquina_casillas) as result, DATE_FORMAT(f.factura_fecha_emision, '%m') AS month, DATE_FORMAT(f.factura_fecha_emision, '%M') AS month_letters
                FROM facturas as f, maquinas as m WHERE f.factura_fecha_emision <= DATE(NOW())
                GROUP BY month";

            // Execute sql
            $query = DB::select($sql);

            // Config chart roacion ultimos 6 meses
            $rotacion_smeses->labels = array_pluck($query, 'month_letters');
            $rotacion_smeses->data = array_pluck($query, 'result');

            // Comisiones maquinas
            $comisiones_maquinas = new \stdClass();
            $comisiones_maquinas->labels = [];
            $comisiones_maquinas->placeholder = [];
            $comisiones_maquinas->data = [];

            // Prepare query
            $sql = "
                SELECT
                    SUM(f.factura_subtotal) * (m.maquina_comision1 / 100) AS comision1,
                    SUM(f.factura_subtotal) * (m.maquina_comision2 / 100) AS comision2,
                    SUM(f.factura_subtotal) * (m.maquina_comision3 / 100) AS comision3,
                    m.maquina_serie AS maquina, m.maquina_comision1 AS barra1, m.maquina_comision2 AS barra2, m.maquina_comision3 AS barra3
                FROM facturas AS f , maquinas AS m
                GROUP BY f.factura_maquina";

            // Execute sql
            $query = DB::select($sql);

            // Config chart comisiones maquinas
            $comisiones_maquinas->labels = array_pluck($query, 'maquina');
            $comisiones_maquinas->placeholder['barra1'] = array_pluck($query, 'barra1');
            $comisiones_maquinas->placeholder['barra2'] = array_pluck($query, 'barra2');
            $comisiones_maquinas->placeholder['barra3'] = array_pluck($query, 'barra3');
            $comisiones_maquinas->data['comision1'] = array_pluck($query, 'comision1');
            $comisiones_maquinas->data['comision2'] = array_pluck($query, 'comision2');
            $comisiones_maquinas->data['comision3'] = array_pluck($query, 'comision3');

            // Prepare object global
            $object->chart_rotacion_dia = $rotacion_dia;
            $object->chart_rotacion_smeses = $rotacion_smeses;
            $object->chart_comisones_maquinas = $comisiones_maquinas;

            return response()->json($object);
        }
    }
}
