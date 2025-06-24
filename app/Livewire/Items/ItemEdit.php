<?php

namespace App\Livewire\Items;

use App\Models\Department;
use App\Models\Inventory;
use Livewire\Component;

class ItemEdit extends Component
{
    public $name, $quantity, $unit, $description;
    public $item, $department_id, $departments;

    public function mount($id)
    {
        $this->item = Inventory::findOrFail($id);
        $this->name = $this->item->name;
        $this->quantity = $this->item->quantity;
        $this->unit = $this->item->unit;
        $this->description = $this->item->description;
        $this->department_id = $this->item->department_id;

        $this->departments = Department::all();
    }

    public function updateItem()
    {
        $this->validate([
            'name' => 'required|unique:inventories,name,' . $this->item->id,
            'quantity' => 'required|numeric',
            'unit' => 'required',
            'description' => 'nullable',
            'department_id' => 'nullable|exists:departments,id',
        ]);
        $this->item->update([
            'name' => $this->name,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'description' => $this->description,
            'department_id' => $this->department_id,
        ]);
        session()->flash('success', 'Item updated successfully');
        return redirect()->route('items');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.items.item-edit');
    }
}
