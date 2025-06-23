<?php

namespace App\Livewire\Structures;

use App\Models\Inventory;
use Livewire\Component;

class StructureEdit extends Component
{
    public $name, $location, $structure;

    public function mount($id)
    {
        $this->structure = Inventory::findOrFail($id);
        $this->name = $this->structure->name;
        $this->location = $this->structure->location;
    }

    public function updateStructure()
    {
        $this->validate([
            'name' => 'required|unique:inventories,name,' . $this->structure->id,
            'location' => 'nullable',
        ]);
        $this->structure->update([
            'name' => $this->name,
            'location' => $this->location,
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
