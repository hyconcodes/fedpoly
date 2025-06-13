<div class="relative mb-6 w-full">
    <div class="flex items-center justify-between">
        <flux:heading size="xl" class="my-4" level="1">{{ __('Create Student Account') }}</flux:heading>

        <form wire:submit.prevent="uploadCsv" enctype="multipart/form-data">
            <div class="relative inline-block me-4">
                <input type="file" id="csv_upload" wire:model="csv_file" accept=".csv,.xlsx,.xls"
                    class="absolute inset-0 opacity-0 cursor-pointer z-10" />

                <flux:button variant="primary" as="span">
                    {{ __('Upload CSV') }}
                </flux:button>
            </div>

            @error('csv_file')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror

            <flux:button type="submit" class="mt-4">{{ __('Import') }}</flux:button>

            @if ($csv_file)
                <p class="text-sm text-center text-purple-700 mt-2">{{ $csv_file->getClientOriginalName() }}</p>
            @endif

        </form>


    </div>
    @include('includes.messages')
    <flux:separator variant="subtle" />

    <form wire:submit="createStudent" class="max-w-2xl space-y-6 my-8">
        <!-- Name -->
        <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name"
            :placeholder="__('Full name')" />

        <!-- Email Address -->
        <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email"
            :placeholder="__('e.g., user@example.com')" />

        <!-- Matric Number -->
        <flux:input wire:model="matric_no" :label="__('Matric Number')" type="text" required autocomplete="matric_no"
            :placeholder="__('Enter your matric number')" />

        <!-- Password -->
        <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="new-password"
            :placeholder="__('Enter a secure password')" />

        <!-- Confirm Password -->
        <flux:input wire:model="password_confirmation" :label="__('Confirm Password')" type="password" required
            autocomplete="new-password" :placeholder="__('Confirm your password')" />

        <div class="flex justify-end gap-3">
            <flux:button variant="subtle" wire:navigate href="{{ route('students.index') }}">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Create Student') }}
            </flux:button>
        </div>
    </form>
</div>
