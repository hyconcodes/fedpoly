<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use App\Models\School;
use Livewire\Component;

class DepartmentCreate extends Component
{
    public $name;
    public $school_id;

    public function createDepartment()
    {
        $this->validate([
            'name' => 'required|string|unique:departments,name',
            'school_id' => 'required|exists:schools,id'
        ]);
        // dd($this->name . $this->school_id);
        $department = new Department();
        $department->name = $this->name;
        $department->school_id = $this->school_id;
        $department->save();
        return to_route('departments.index')->with('success', 'Department created successfully.');
    }
    public function render()
    {
        $schools = School::all();
        return view('livewire.departments.department-create', compact('schools'));
    }
}
