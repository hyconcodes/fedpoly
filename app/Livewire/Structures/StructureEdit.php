<?php

namespace App\Livewire\Structures;

use App\Models\Department;
use App\Models\Inventory;
use Livewire\Component;

class StructureEdit extends Component
{
    public $name, $location, $structure, $department_id, $departments;

    public function mount($id)
    {
        $this->structure = Inventory::findOrFail($id);
        $this->name = $this->structure->name;
        $this->location = $this->structure->location;
        $this->department_id = $this->structure->department_id;

        $this->departments = Department::all();
    }

    public function updateStructure()
    {
        $this->validate([
            'name' => 'required|unique:inventories,name,' . $this->structure->id,
            'location' => 'nullable',
            'department_id' => 'required|exists:departments,id'
        ]);
        $this->structure->update([
            'name' => $this->name,
            'location' => $this->location,
            'department_id' => $this->department_id
        ]);
        session()->flash('success', 'Structure updated successfully');
        return redirect()->route('structures');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.structures.structure-edit');
    }
}
