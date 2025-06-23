<?php

namespace App\Livewire\Structures;

use App\Models\Inventory;
use Livewire\Component;

class StructureCreate extends Component
{
    public $name, $location;

    public function saveStructure()
    {
        $this->validate([
            'name' => 'required|unique:inventories,name|min:3',
            'location' => 'nullable',
        ]);
        Inventory::create([
            'name' => $this->name,
            'location' => $this->location,
            'type' => 'structure',
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
