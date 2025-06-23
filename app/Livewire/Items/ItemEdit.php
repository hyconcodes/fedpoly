<?php

namespace App\Livewire\Items;

use App\Models\Inventory;
use Livewire\Component;

class ItemEdit extends Component
{
    public $name, $quantity, $unit, $description;
    public $item;

    public function mount($id)
    {
        $this->item = Inventory::findOrFail($id);
        $this->name = $this->item->name;
        $this->quantity = $this->item->quantity;
        $this->unit = $this->item->unit;
        $this->description = $this->item->description;
    }

    public function updateItem()
    {
        $this->validate([
            'name' => 'required|unique:inventories,name,' . $this->item->id,
            'quantity' => 'required|numeric',
            'unit' => 'required',
            'description' => 'nullable',
        ]);
        $this->item->update([
            'name' => $this->name,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'description' => $this->description,
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
