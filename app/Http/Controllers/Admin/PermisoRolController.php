<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Base\Module, App\Models\Base\Role, App\Models\Base\PermissionRol, App\Models\Base\Permission;
use Datatables, DB, Log;

class PermisoRolController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $query = Module::query();
            $query->select('modulos.id', 'display_name', 'nivel1', 'nivel2', 'nivel3', 'nivel4');
            $query->orderBy('nivel1', 'asc');
            $modules = $query->get();
            $data = [];
            foreach ($modules as $module)
            {
                $object = new \stdClass();
                $object->id = $module->id;
                $object->display_name = $module->display_name;
                $object->nivel1 = $module->nivel1;
                $object->nivel2 = $module->nivel2;
                $object->nivel3 = $module->nivel3;
                $object->nivel4 = $module->nivel4;

                $query = PermissionRol::query();
                $query->where('role_id', $request->role_id);
                $query->where('module_id', $module->id);
                $query->orderBy('permission_id', 'asc');
                $object->mpermissions = $query->pluck('permission_id');

                $data[] = $object;
            }
            return response()->json($data);
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            DB::beginTransaction();
            try {
                $module = Module::find($id);
                if(!$module instanceof Module) {
                    DB::rollback();
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }

                $role = Role::find($request->role_id);
                if(!$role instanceof Role) {
                    DB::rollback();
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }

                $permissions = Permission::get();
                foreach ($permissions as $permission) {
                    $query = PermissionRol::query();
                    $query->where('role_id', $role->id);
                    $query->where('module_id', $module->id);
                    $query->where('permission_id', $permission->id);
                    $permissionrole = $query->first();

                    if($request->has("permiso_$permission->id")) {
                        if(!$permissionrole instanceof PermissionRol){
                            $permissionrole = new PermissionRol;
                            $permissionrole->role_id = $role->id;
                            $permissionrole->module_id = $module->id;
                            $permissionrole->permission_id = $permission->id;
                            $permissionrole->save();
                        }
                    }else{
                        if($permissionrole instanceof PermissionRol){
                            PermissionRol::where('role_id', $role->id)->where('module_id', $module->id)->where('permission_id', $permission->id)->delete();
                        }
                    }
                }

                // Commit Transaction
                DB::commit();
                return response()->json(['success' => true]);
            }catch(\Exception $e){
                DB::rollback();
                Log::error($e->getMessage());
                return response()->json(['success' => false, 'errors' => trans('app.exception')]);
            }
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
