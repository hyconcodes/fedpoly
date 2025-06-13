<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use App\Models\School;
use Livewire\Component;

class DepartmentEdit extends Component
{
    public $name;
    public $department;
    public $schools;
    public $school_id;

    public function mount($id)
    {
        $this->schools = School::all();
        $this->school_id = Department::with('school')->find($id)->school_id;
        $this->department = Department::find($id);
        $this->name = $this->department->name;
    }

    public function updateDepartment()
    {
        $this->validate([
            'name' => 'required|string|unique:departments,name,' . $this->department->id,
            'school_id' => 'required|exists:schools,id'
        ]);
        $department = Department::find($this->department->id);
        $department->name = $this->name;
        $department->school_id = $this->school_id;
        $department->save();
        return to_route('departments.index')->with('success', 'Department updated successfully.');
    }
    public function render()
    {
        return view('livewire.departments.department-edit');
    }
}
