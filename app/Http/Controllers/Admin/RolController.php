<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Base\Role, App\Models\Base\Permission;
use DB, Log, Datatables, Cache;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Role::query();
            return Datatables::of($query)->make(true);
        }
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
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
            $rol = new Role;
            if ($rol->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Rol
                    $rol->fill($data);
                    $rol->save();

                    // Forget cache
                    Cache::forget( Role::$key_cache );
                    // Commit Transaction
                    DB::commit();

                    return response()->json(['success' => true, 'id' => $rol->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $rol->errors]);
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
        $rol = Role::findOrFail($id);
        if ($request->ajax()) {

            if(!in_array($rol->name, ['admin'])) {
                $rol->permissions = Permission::get()->toArray();
            }
            return response()->json($rol);
        }
        return view('admin.roles.show', ['rol' => $rol]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        return view('admin.roles.create', ['rol' => $rol]);
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
            $rol = Role::findOrFail($id);
            if ($rol->isValid($data)) {
                DB::beginTransaction();
                try {
                    $valRol = Role::where('name', $request->name)->first();
                    if(!$valRol instanceof Role) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar Key, por favor verifique la información o consulte al administrador.']);
                    }

                    // Rol
                    $rol->fill($data);
                    $rol->save();
                    // Commit Transaction
                    DB::commit();
                    // Forget cache
                    Cache::forget( Role::$key_cache );

                    return response()->json(['success' => true, 'id' => $rol->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $rol->errors]);
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
