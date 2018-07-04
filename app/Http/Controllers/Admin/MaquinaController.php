<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Base\Machine;
use Datatables, DB, Log;

class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Machine::query();
            return Datatables::of($query)->make(true);
        }
        return view('admin.machines.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.machines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $machine = new Machine;
            if ($machine->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Maquina
                    $machine->fill($data);
                    $machine->maquina_contraseña = bcrypt($request->maquina_contraseña);
                    $machine->maquina_ultima = date('Y-m-d H:m:s');
                    $machine->save();

                    DB::commit();
                    return response()->json(['success' => true, 'id' => $machine->id ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' =>  $machine->errors]);
        }
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Request $request, $id)
    {
        $machine = Machine::findOrFail($id);
        if ($request->ajax()) {
            return response()->json($machine);
        }
        return view('admin.machines.show', ['machine' => $machine]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $machine = Machine::findOrFail($id);
        return view('admin.machines.edit', ['machine' => $machine]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $machine = Machine::findOrFail($id);
            if ($machine->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Maquina
                    $machine->fill($data);
                    $machine->maquina_ultima = date('Y-m-d H:m:s');

                    if ($request->has('maquina_contraseña')) {
                        $machine->maquina_contraseña = bcrypt($request->maquina_contraseña);
                    }
                    
                    $machine->save();

                    DB::commit();
                    return response()->json(['success' => true, 'id' => $machine->id ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' =>  $machine->errors]);
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
