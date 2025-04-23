<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', [
            'title' => 'Roles',
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('roles.create', [
            'title' => 'Create Role'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,except,id'
        ]);
        Role::create($validatedData);
        return to_route('roles.index')
            ->with('success', 'Role created successfully')
            ->with('flag', 'success');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'title' => 'Edit Role',
            'role' => $role,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $role->update($validatedData);
        return to_route('roles.index')
            ->with('success', 'Role updated successfully')
            ->with('flag', 'success');
    }

    public function show(Role $role)
    {
        return view('roles.show', [
            'title' => 'Role Details',
            'role' => $role,
        ]);
    }
}
