<div class="relative mb-6 w-full">
    <flux:heading size="xl" class="my-4" level="1">{{ __('Create New Department') }}</flux:heading>
    @include('includes.messages')
    <flux:separator variant="subtle" />

    <form wire:submit="createDepartment" class="max-w-2xl space-y-6 my-8">
        <!-- Department Name -->
        <flux:input wire:model="name" :label="__('Department Name')" type="text" required autofocus
            autocomplete="organization" :placeholder="__('e.g., Computer Science')" />

        <!-- School Selection -->
        @if (isset($schools) && !$schools->isEmpty())
            <flux:select wire:model="school_id" :label="__('School')" :placeholder="__('Select a school')" required>
                @foreach ($schools as $school)
                    <flux:select.option :value="$school->id">{{ $school->name }}</flux:select.option>
                @endforeach
            </flux:select>
        @else
            {{-- Fallback or loading state if schools are not yet available --}}
            <p class="text-sm text-secondary-600 dark:text-secondary-400">
                {{ __('Loading schools or no schools available to assign.') }}</p>
        @endif

        <div class="flex justify-end gap-3">
            <flux:button variant="subtle" wire:navigate href="{{ route('departments.index') }}">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary" class="bg-purple-600 hover:bg-purple-700" >
                {{ __('Create Department') }}
            </flux:button>
        </div>
    </form>
</div>
