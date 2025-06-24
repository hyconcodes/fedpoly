<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;

class DepartmentShow extends Component
{
    public $department;

    public function mount($id){
        $this->department = Department::find($id);
        dd($this->department->students());
    }
    public function render()
    {
        return view('livewire.departments.department-show');
    }
}
