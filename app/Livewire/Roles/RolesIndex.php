<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{    
    public function destroyRole($id)
    {
        $role = Role::find($id);
        if (!$role) {
            session()->flash('error', 'Role not found.');
            redirect(route('roles.index'));
        }
        $role->delete();
        session()->flash('message', 'Role deleted successfully.');
        redirect(route('roles.index'));
    }

    public function render()
    {
        $roles = Role::with('permissions')->get();
        return view('livewire.roles.roles-index', compact('roles'));
    }
}
