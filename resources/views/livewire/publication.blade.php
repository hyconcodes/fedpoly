<?php

use Livewire\Volt\Component;

new class extends Component {
    public $title;
    public $journal_conference;
    public $publication_year;
    public $doi;
    public $publications;
    public $editing = false;
    public $editingId;
    public $search = '';

    public function mount()
    {
        $this->publications = auth()->user()->publications ?? [];
    }

    public function updatedSearch()
    {
        $this->publications = auth()->user()->publications()
            ->where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('journal_conference', 'like', '%' . $this->search . '%')
                    ->orWhere('publication_year', 'like', '%' . $this->search . '%')
                    ->orWhere('doi', 'like', '%' . $this->search . '%');
            })
            ->get();
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required',
            'journal_conference' => 'required',
            'publication_year' => 'required|numeric|min:1900|max:' . date('Y'),
            'doi' => 'nullable',
        ]);

        $validated['user_id'] = auth()->id();
        
        if ($this->editing) {
            auth()->user()->publications()->find($this->editingId)->update($validated);
            $this->editing = false;
            $this->editingId = null;
        } else {
            auth()->user()->publications()->create($validated);
        }

        $this->reset(['title', 'journal_conference', 'publication_year', 'doi']);
        $this->publications = auth()->user()->publications;
    }

    public function edit($id)
    {
        $publication = auth()->user()->publications()->find($id);
        $this->title = $publication->title;
        $this->journal_conference = $publication->journal_conference;
        $this->publication_year = $publication->publication_year;
        $this->doi = $publication->doi;
        $this->editing = true;
        $this->editingId = $id;
    }

    public function cancelEdit()
    {
        $this->editing = false;
        $this->editingId = null;
        $this->reset(['title', 'journal_conference', 'publication_year', 'doi']);
    }

    public function delete($id)
    {
        auth()->user()->publications()->find($id)->delete();
        $this->publications = auth()->user()->publications;
    }
}; ?>
<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Publications') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your publications...') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    @include('includes.messages')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">{{ $editing ? 'Edit Publication' : 'Add Publication' }}</h2>
            <form wire:submit="save">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <flux:input type="text" wire:model="title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Journal/Conference</label>
                        <flux:input type="text" wire:model="journal_conference"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Publication Year</label>
                        <flux:input type="number" wire:model="publication_year"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">DOI (Optional)</label>
                        <flux:input type="text" wire:model="doi"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div class="flex gap-2">
                        <flux:button type="submit"
                            class="flex-1 !bg-purple-500 !text-white py-2 px-4 !rounded-md !hover:bg-purple-600">
                            {{ $editing ? 'Update Publication' : 'Add Publication' }}
                        </flux:button>
                        @if($editing)
                        <flux:button type="button" wire:click="cancelEdit"
                            class="!bg-gray-500 !text-white py-2 px-4 !rounded-md !hover:bg-gray-600">
                            Cancel
                        </flux:button>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Your Publications</h2>
                <div class="w-64">
                    <flux:input type="text" wire:model.live.debounce.300ms="search" placeholder="Search publications..."
                        class="w-full rounded-md border-gray-300 shadow-sm" />
                </div>
            </div>
            @if (count($publications) > 0)
                <div class="space-y-4">
                    @foreach($publications as $publication)
                    <div class="border p-4 rounded-md">
                        <h3 class="font-medium">{{ $publication->title }}</h3>
                        <p class="text-gray-600">{{ $publication->journal_conference }}</p>
                        <p class="text-gray-500 text-sm">Published: {{ $publication->publication_year }}</p>
                        @if($publication->doi)
                        <p class="text-gray-500 text-sm">DOI: {{ $publication->doi }}</p>
                        @endif
                        <div class="flex gap-2 mt-4">
                            <flux:button wire:click="edit({{ $publication->id }})"
                                class="!bg-blue-500 !text-white py-2 px-4 !rounded-md !hover:bg-blue-600">
                                Edit
                            </flux:button>
                            <flux:button wire:click="delete({{ $publication->id }})" wire:confirm="Are you sure you want to delete this publication?"
                                class="!bg-red-500 !text-white py-2 px-4 !rounded-md !hover:bg-red-600">
                                Delete Publication
                            </flux:button>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>No publications found.</p>
                    <p class="text-sm">Try adjusting your search or add new publications using the form.</p>
                </div>
            @endif
        </div>
    </div>
</div>
