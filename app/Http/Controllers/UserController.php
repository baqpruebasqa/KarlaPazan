<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required'
        ]);

        return DB::transaction(function ()  use($request) {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
        });

    }

    public function create()
    {
        $role = Role::pluck('name')->all();

        return Inertia::render('Usuario/Create', [
            'rolesDisponible' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => ["required","email", Rule::unique('users')->ignore($id)],
            'password' => 'nullable|confirmed',
        ]);

        return DB::transaction(function ()  use($request, $id) {
            $input = $request->all();

            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }

            $user = User::find($id);
            $user->update($input);

            if($request->roles){
                DB::table('model_has_roles')->where('model_id',$id)->delete();
                $user->assignRole($request->input('roles'));
            }
        });

    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::select('name', 'id')->get();
        $user['userRoles'] = $user->roles; // Agregar los roles asignados al arreglo $user
        $user = $user->toArray(); // Convertir el objeto $user a un arreglo

        return Inertia::render('Usuario/Edit',[
            'user' => $user,
            'rolesDisponible' => $roles,
        ]);

    }

}
