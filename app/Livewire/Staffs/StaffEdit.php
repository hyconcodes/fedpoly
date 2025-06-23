<?php

namespace App\Livewire\Staffs;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class StaffEdit extends Component
{
    public $staff;
    public $role, $role_id, $roles;
    public $name, $email, $password, $password_confirmation;

    public function mount($id)
    {
        $this->staff = User::find($id);
        $this->name = $this->staff->name;
        $this->email = $this->staff->email;
        $this->role_id = $this->staff->roles->pluck('id');
    }
    public function updateStaff()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|min:3|unique:users,email,' . $this->staff->id,
            'password' => 'nullable|string|confirmed|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);
        $this->staff->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $this->role = Role::find($this->role_id);
        $this->staff->syncRoles($this->role);
        $this->staff->save();
        if ($this->password) {
            Password::sendResetLink(['email' => $this->staff->email]);
            session()->flash('success', __('Staff account updated successfully! A reset link has been sent to their email.'));
            return to_route('staffs.index');
        } else {
            session()->flash('success', __('Staff account updated successfully!'));
            return to_route('staffs.index');
        }
    }

    public function render()
    {
        $this->roles = Role::whereNotIn('name', ['Student', 'Super admin'])->get();
        return view('livewire.staffs.staff-edit');
    }
}
