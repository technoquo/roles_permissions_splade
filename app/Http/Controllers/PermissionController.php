<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Tables\Permissions;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permissions::class
        ]);
    }


    public function create()
    {
        // $form = SpladeForm::make()
        //     ->action(route('admin.permissions.store'))
        //     ->class('space-y-4 p-4 bg-white rounded')
        //     ->fields([
        //         Input::make('name')->label('Name'),
        //         Submit::make()->label('Save')
        //     ]);

        // return view('admin.permissions.create', [
        //     'form' => $form
        // ]);

        return view('admin.permissions.create', [
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    public function store(CreatePermissionRequest $request)
    {
        $permission = Permission::create($request->validated());
        $permission->syncRoles($request->roles);
        Splade::toast('Permission created')->autoDismiss(3);
        return to_route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        // $form = SpladeForm::make()
        //     ->action(route('admin.permissions.update', $permission))
        //     ->method('PUT')
        //     ->class('space-y-4 p-4 bg-white rounded')
        //     ->fields([
        //         Input::make('name')->label('Name'),
        //         Submit::make()->label('Update')
        //     ])
        //     ->fill($permission);

        // return view('admin.permissions.edit', [
        //     'form' => $form
        // ]);

        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        $permission->syncRoles($request->roles);
        Splade::toast('Permission updated')->autoDismiss(3);
        return to_route('admin.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        Splade::toast('Role deleted')->autoDismiss(3);
        return back();
    }
}
