<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Base\Coin;
use Datatables;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Coin::query();
            $query->select('monedas.*', 'maquina_serie');
            $query->join('maquinas', 'moneda_maquina', '=', 'maquinas.id');
            $query->orderBy('id', 'desc');
            return Datatables::of($query)->make(true);
        }
        return view('admin.coins.index');
    }
}
