<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Base\Finalized;
use Datatables;

class FinalizedController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Finalized::query();
            $query->select('finalizados.*', 'maquina_serie');
            $query->join('maquinas', 'finalizado_maquina', '=', 'maquinas.id');
            return Datatables::of($query)->make(true);
        }
        return view('admin.finished.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $finalized = Finalized::findOrFail($id);
        return view('admin.finished.show', ['finalized' => $finalized]);
    }
}
