<?php

namespace App\Livewire\Items;

use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;

class ItemIndex extends Component
{
    use WithPagination;

    public string $search = '';
    protected $updatesQueryString = ['search'];

    public function deleteItem($id)
    {
        $item = Inventory::findOrFail($id);
        $item->delete();
        session()->flash('success', 'Item deleted successfully');
        return redirect()->route('items');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $items = Inventory::items()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('quantity', 'like', '%' . $this->search . '%')
                    ->orWhere('unit', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view('livewire.items.item-index', compact('items'));
    }
}
