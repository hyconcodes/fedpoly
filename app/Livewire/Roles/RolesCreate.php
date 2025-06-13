<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesCreate extends Component
{
    public $name = '';
    public $permissions = [];
    public $allPermissions = [];

    public function mount()
    {
        $this->allPermissions = Permission::all();
    }
    public function createRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);
        // dd($this->permissions);
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->permissions);
        // session()->flash('message', 'Role created successfully.');
        return to_route('roles.index')->with('message', 'Role created successfully.');
    }
    public function render()
    {
        return view('livewire.roles.roles-create');
    }
}
