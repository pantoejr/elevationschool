<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('permissions.index', [
            'title' => 'Permissions',
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('permissions.create', [
            'title' => 'Create Permission',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,except,id',
        ]);

        Permission::create($validatedData);
        return to_route('permissions.index')
            ->with('success', 'Permission created successfully.')
            ->with('flag', 'success');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', [
            'permission' => $permission,
            'title' => 'Edit Permission'
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $permission->update($validatedData);
        return to_route('permissions.index')
            ->with('success', 'Permission updated successfully')
            ->with('flag', 'success');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return to_route('permissions.index')
            ->with('success', 'Permission deleted successfully')
            ->with('flag', 'success');
    }
}
