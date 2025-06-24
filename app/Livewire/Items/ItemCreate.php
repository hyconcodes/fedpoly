<?php

namespace App\Livewire\Items;

use App\Models\Department;
use App\Models\Inventory;
use Livewire\Component;

class ItemCreate extends Component
{
    public $name, $quantity, $unit, $description, $department_id, $departments;

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function saveItem()
    {
        $this->validate([
            'name' => 'required|unique:inventories,name|min:3',
            'quantity' => 'required|numeric',
            'unit' => 'required',
            'description' => 'nullable',
            'department_id' => 'required|exists:departments,id',
        ]);
        Inventory::create([
            'name' => $this->name,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'description' => $this->description,
            'type' => 'item',
            'department_id' => $this->department_id,
        ]);
        session()->flash('success', 'Item created successfully');
        return redirect()->route('items');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.items.item-create');
    }
}
