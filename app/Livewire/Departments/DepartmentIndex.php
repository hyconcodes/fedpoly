<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class DepartmentIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search;

    public function search()
    {
        $this->resetPage();
    }

    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        $department->delete();
        return to_route('departments.index')->with('success', 'Department deleted successfully.');
    }
    public function render()
    {
        $departments = Department::with('school')
        ->where('name', 'like', '%'.$this->search.'%')
        ->orderBy('created_at', 'desc')
        ->paginate(4);
        return view('livewire.departments.department-index', compact('departments'));
    }
}
