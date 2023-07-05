<?php

namespace App\Http\Controllers;

use App\Tables\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Roles::class
        ]);
    }


    public function create()
    {
        // $form = SpladeForm::make()
        //     ->action(route('admin.roles.store'))
        //     ->class('space-y-4 p-4 bg-white rounded')
        //     ->fields([
        //         Input::make('name')->label('Name'),
        //         Submit::make()->label('Save')
        //     ]);

        // return view('admin.roles.create', [
        //     'form' => $form
        // ]);

        return view('admin.roles.create', [
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        $role = Role::create($request->validated());
        $role->syncPermissions($request->permissions);
        Splade::toast('Role created')->autoDismiss(3);
        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        // $form = SpladeForm::make()
        //     ->action(route('admin.roles.update', $role))
        //     ->method('PUT')
        //     ->class('space-y-4 p-4 bg-white rounded')
        //     ->fields([
        //         Input::make('name')->label('Name'),
        //         Submit::make()->label('Update')
        //     ])
        //     ->fill($role);

        // return view('admin.roles.edit', [
        //     'form' => $form
        // ]);

        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        $role->syncPermissions($request->permissions);
        Splade::toast('Role updated')->autoDismiss(3);
        return to_route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        Splade::toast('Role deleted')->autoDismiss(3);
        return back();
    }
}
