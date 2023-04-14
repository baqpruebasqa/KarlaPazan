<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array',
        ]);

        return DB::transaction(function ()  use($request) {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission')); //asigno permisos existentes
        });
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        return DB::transaction(function ()  use($request, $id) {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();

            $role->syncPermissions($request->input('permission'));
        });

    }

    public function create()
    {
        return Inertia::render('Roles/Create', [
            'acciones' => Permission::orderBy('name')->select([
                'id', 'name'
            ])->get()
        ]);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return Inertia::render('Roles/Edit',[
            'rol' => $role,
            'rolPermissions' => $rolePermissions,
            'acciones' => Permission::all()
        ]);
    }
}
