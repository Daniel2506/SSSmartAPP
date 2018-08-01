<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Base\Bills;
use Datatables, DB, Log;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Bills::query();
            $query->select('facturas.*', 'maquina_serie');
            $query->join('maquinas', 'factura_maquina', '=', 'maquinas.id');
            $query->orderBy('factura_fecha_emision', 'desc');
            return Datatables::of($query)->make(true);
        }
        return view('admin.bills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bills::findOrFail($id);
        return view('admin.bills.show', ['bill' => $bill]);
    }
}
