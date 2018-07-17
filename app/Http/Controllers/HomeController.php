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

            // Init global object
            $object = new \stdClass();
            $object->success = true;

            // Rotacion X dia
            $rotacion_dia = new \stdClass();
            $rotacion_dia->labels = [];
            $rotacion_dia->data = [];

            // Prepare query
            $sql = "
                SELECT (COUNT(f.id) / m.maquina_casillas) as result, DATE_FORMAT(f.factura_fecha_emision, '%w') AS day, DATE_FORMAT(f.factura_fecha_emision, '%W') AS day_letters
                FROM facturas as f, maquinas as m
                GROUP BY day";

            // Execute sql
            $query = DB::select($sql);

            // Config chart
            $rotacion_dia->labels = array_pluck($query, 'day_letters');
            $rotacion_dia->data = array_pluck($query, 'result');

            // Prepare global object
            $object->chart_rotacion_dia = $rotacion_dia;
            return response()->json($object);
        }
    }
}
