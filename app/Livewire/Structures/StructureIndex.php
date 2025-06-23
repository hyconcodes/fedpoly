<?php

namespace App\Livewire\Structures;

use App\Models\Inventory;
use Livewire\Component;

class StructureIndex extends Component
{
    // public $structures;
    public function deleteStructure(Inventory $structure)
    {
        $structure->delete();
        session()->flash('success', 'Structure deleted successfully');
        return redirect()->route('structures');
    }

    public function render()
    {
        $structures = Inventory::structures()->orderBy('created_at', "desc")->paginate(8);
        return view('livewire.structures.structure-index', compact('structures'));
    }
}
