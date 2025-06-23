<?php

namespace App\Livewire\Structures;

use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;

class StructureIndex extends Component
{
    use WithPagination;

    public string $search = '';
    protected $updatesQueryString = ['search'];

    public function deleteStructure($id)
    {
        $structure = Inventory::findOrFail($id);
        $structure->delete();
        session()->flash('success', 'Structure deleted successfully');        
        return redirect()->route('structures');
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $structures = Inventory::structures()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('livewire.structures.structure-index', compact('structures'));
    }
}
