<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Edit School') }}</flux:heading>
    @include('includes.messages')
    <flux:separator variant="subtle" />

    <form wire:submit="updateSchool" class="max-w-2xl space-y-6 my-8">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('School name')" />
        
        <div class="flex justify-end gap-3">
            <flux:button variant="subtle" wire:navigate href="{{ route('schools.index') }}">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Update School') }}
            </flux:button>
        </div>
    </form>
</div>