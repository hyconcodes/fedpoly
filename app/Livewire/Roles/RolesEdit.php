<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesEdit extends Component
{
    public $name;
    public $role;
    public $allPermissions = [];
    public $permissions = [];

    public function mount($id)
    {
        $this->role = Role::find($id);
        $this->name = $this->role->name;
        $this->allPermissions = Permission::all();
        $this->permissions = $this->role->permissions->pluck('name')->toArray();
    }

    public function updateRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->role->id
        ]);
        $this->role->update(['name' => $this->name]);
        $this->role->syncPermissions($this->permissions);
        session()->flash('message', 'role updated');
        return redirect(route('roles.index'));
    }


    public function render()
    {
        return view('livewire.roles.roles-edit');
    }
}
