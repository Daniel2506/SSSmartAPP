<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\HomeCharts;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function charts(Request $request)
    {
        if ($request->ajax()) {

            // Prepare object global
            $graphs = new HomeCharts($request);
            if ($graphs->error) {
                return response()->json(['success' => false, 'errors' => $graphs->error]);
            }

            // Config charts
            $object = new \stdClass();
            $object->chart_rotacion_dia = $graphs->rotacionPorDia();
            $object->chart_rotacion_smeses = $graphs->rotacionSeisMeses();
            $object->chart_ventas_smeses = $graphs->ventasSeisMeses();

            return response()->json(['success' => true, 'object' => $object]);
        }
    }
}
