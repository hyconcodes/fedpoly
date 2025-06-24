<?php

namespace App\Livewire\Structures;

use App\Models\Department;
use App\Models\Inventory;
use Livewire\Component;

class StructureCreate extends Component
{
    public $name, $location, $department_id, $departments;

    public function mount()
    {
        $this->departments = Department::all();
    }
    public function saveStructure()
    {
        $this->validate([
            'name' => 'required|unique:inventories,name|min:3',
            'location' => 'nullable',
            'department_id' => 'required|exists:departments,id'
        ]);
        Inventory::create([
            'name' => $this->name,
            'location' => $this->location,
            'type' => 'structure',
            'department_id' => $this->department_id
        ]);
        session()->flash('success', 'Structure created successfully');
        return redirect()->route('structures');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.structures.structure-create');
    }
}
