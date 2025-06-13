<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Create Role') }}</flux:heading>
    @include('includes.messages')
    <flux:separator variant="subtle" />

    <form wire:submit="createRole" class="max-w-2xl space-y-6 my-8">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Role name')" />

        <!-- Permissions -->
        <flux:checkbox.group wire:model="permissions" label="Permission">
            @foreach ($allPermissions as $permission)
            <flux:checkbox label="{{$permission->name}}" value="{{$permission->name}}" checked />
            @endforeach
        </flux:checkbox.group>

        <div class="flex justify-end gap-3">
            <flux:button variant="subtle" wire:navigate href="{{ route('roles.index') }}">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Create Role') }}
            </flux:button>
        </div>
    </form>


</div>