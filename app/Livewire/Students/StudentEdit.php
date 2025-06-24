<?php

namespace App\Livewire\Students;

use App\Models\Department;
use App\Models\Program;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class StudentEdit extends Component
{
    public $student, $school_id, $program_id, $department_id, $schools, $departments = [], $programs;
    public $name, $email, $matric_no, $password, $password_confirmation;

    public function mount($id)
    {
        $this->student = User::find($id);
        $this->name = $this->student->name;
        $this->email = $this->student->email;
        $this->matric_no = $this->student->matric_no;
        $this->school_id = $this->student->school_id;
        $this->department_id = $this->student->department_id;
        $this->program_id = $this->student->program_id;

        $this->schools = School::all();
        $this->programs = Program::all();
    }

    public function populateDepartment($id)
    {
        $this->departments = School::find($id)->departments;
    }

    public function updateStudent()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|min:3|unique:users,email,' . $this->student->id,
            'password' => 'nullable|string|confirmed|min:6',
            'matric_no' => 'nullable|string|unique:users,matric_no,' . $this->student->id,
            'school_id' => 'required|exists:schools,id',
            'department_id' => 'nullable|exists:departments,id',
            'program_id' => 'required|exists:programs,id',
        ]);
        $this->student->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'matric_no' => $this->matric_no,
            'school_id' => $this->school_id,
            'department_id' => $this->department_id,
            'program_id' => $this->program_id,
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
