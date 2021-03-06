<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Base\CoinCasket;
use Datatables;

class CoinsCasketController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = CoinCasket::query();
            $query->select('coins.*', 'maquina_serie');
            $query->join('maquinas', 'coin_maquina', '=', 'maquinas.id');
            $query->orderBy('id', 'desc');
            return Datatables::of($query)->make(true);
        }
        return view('admin.coinscasket.index');
    }
}
