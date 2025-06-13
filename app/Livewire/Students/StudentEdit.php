<?php

namespace App\Livewire\Students;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class StudentEdit extends Component
{
    public $student;
    public $name, $email, $matric_no, $password, $password_confirmation;

    public function mount($id)
    {
        $this->student = User::find($id);
        $this->name = $this->student->name;
        $this->email = $this->student->email;
        $this->matric_no = $this->student->matric_no;
    }

    public function updateStudent()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|min:3|unique:users,email,' . $this->student->id,
            'password' => 'nullable|string|confirmed|min:6',
            'matric_no' => 'nullable|string|unique:users,matric_no,' . $this->student->id,
        ]);
        $this->student->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'matric_no' => $this->matric_no,
        ]);
        if ($this->password) {
            // Send password reset email
            Password::sendResetLink(['email' => $this->student->email]);
            session()->flash('success', __('Student account updated successfully! A reset link has been sent to their email.'));
            return to_route('students.index');
        } else {
            session()->flash('success', __('Student account updated successfully!'));
            return to_route('students.index');
        }
    }
    public function render()
    {
        return view('livewire.students.student-edit');
    }
}
