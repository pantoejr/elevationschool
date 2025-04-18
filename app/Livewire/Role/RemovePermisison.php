<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RemovePermisison extends Component
{
    public $roleId;
    public $removableSelectedPermissions = [];

    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $this->removableSelectedPermissions = [];
    }

    public function render()
    {
        $role = Role::find($this->roleId);

        if (!$role) {
            return abort(404);
        }

        $rolePermissions = $role->permissions()->pluck('name', 'id');

        return view('livewire.role.remove-permisison', compact('role', 'rolePermissions'));
    }

    public function submit()
    {
        $role = Role::findById($this->roleId);

        foreach ($this->removableSelectedPermissions as $permissionId) {
            $permission = Permission::findById($permissionId);
            if ($permission) {
                $role->revokePermissionTo($permission);
            }
        }

        return redirect()->route('roles.show', $role->id)
            ->with('msg', 'Permissions revoked successfully!')
            ->with('flag', 'danger');
    }
}
