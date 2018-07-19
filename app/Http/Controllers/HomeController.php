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

            DB::statement('SET lc_time_names = es_ES');

            // Init global object
            $object = new \stdClass();
            $object->success = true;
            $object->chart_rotacion_dia = [];
            $object->chart_rotacion_smeses = [];

            // Rotacion X dia
            $rotacion_dia = new \stdClass();
            $rotacion_dia->labels = [];
            $rotacion_dia->data = [];

            // Prepare query
            /* Nota: DATE_SUB('2018-06-27', INTERVAL 8 DAY) Cambiar por DATE(NOW())*/
            $sql = "
                SELECT (COUNT(f.id) / m.maquina_casillas) as result, DATE_FORMAT(f.factura_fecha_emision, '%w') AS day, DATE_FORMAT(f.factura_fecha_emision, '%W') AS day_letters
                FROM facturas as f, maquinas as m WHERE f.factura_fecha_emision > DATE_SUB('2018-06-27', INTERVAL 8 DAY) AND f.factura_fecha_emision <= DATE(NOW())
                GROUP BY f.factura_fecha_emision ORDER BY DATE_FORMAT(DATE(NOW()), '%w')";

            // Execute sql
            $query = DB::select($sql);

            // Config chart
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

            // Config chart
            $rotacion_smeses->labels = array_pluck($query, 'month_letters');
            $rotacion_smeses->data = array_pluck($query, 'result');

            // Prepare object global
            $object->chart_rotacion_dia = $rotacion_dia;
            $object->chart_rotacion_smeses = $rotacion_smeses;

            return response()->json($object);
        }
    }
}
