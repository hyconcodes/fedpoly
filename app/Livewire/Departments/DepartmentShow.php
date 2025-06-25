<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentShow extends Component
{
    use WithPagination;

    public $department;
    public $departmentId;
    public $perPage = 8;
    public $studentSearch = '';
    public $staffSearch = '';
    public $structureSearch = '';
    public $itemSearch = '';

    public function updatingStudentSearch()
    {
        $this->resetPage();
    }

    public function updatingStaffSearch()
    {
        $this->resetPage();
    }

    public function updatingStructureSearch()
    {
        $this->resetPage();
    }

    public function updatingItemSearch()
    {
        $this->resetPage();
    }

    public function mount($id)
    {
        $this->departmentId = $id;
        $this->department = Department::findOrFail($id);
    }

    public function render()
    {
        $this->department = Department::findOrFail($this->departmentId);

        $students = $this->department->students()
            ->when($this->studentSearch, function ($query) {
                $query->where('name', 'like', '%'.$this->studentSearch.'%');
            })
            ->paginate($this->perPage);

        $staffs = $this->department->staffs()
            ->when($this->staffSearch, function ($query) {
                $query->where('name', 'like', '%'.$this->staffSearch.'%');
            })
            ->paginate($this->perPage);

        $structures = $this->department->structures()
            ->when($this->structureSearch, function ($query) {
                $query->where('name', 'like', '%'.$this->structureSearch.'%');
            })
            ->paginate($this->perPage);

        $items = $this->department->items()
            ->when($this->itemSearch, function ($query) {
                $query->where('name', 'like', '%'.$this->itemSearch.'%');
            })
            ->paginate($this->perPage);

        return view('livewire.departments.department-show', [
            'students' => $students,
            'staffs' => $staffs,
            'structures' => $structures,
            'items' => $items,
            'studentSearch' => $this->studentSearch,
            'staffSearch' => $this->staffSearch,
            'structureSearch' => $this->structureSearch,
            'itemSearch' => $this->itemSearch,
        ]);
    }
}
