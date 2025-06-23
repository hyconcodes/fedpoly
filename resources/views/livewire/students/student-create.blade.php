<div class="relative mb-6 w-full">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <flux:heading size="xl" class="my-4" level="1">{{ __('Create Student Account') }}</flux:heading>

        <form wire:submit.prevent="uploadCsv" enctype="multipart/form-data"
            class="flex flex-col md:flex-row w-full md:w-auto items-start md:items-center gap-4">
            <flux:heading class="flex items-center gap-2">
                Info

                <flux:tooltip>
                    <flux:button icon="information-circle" size="sm" variant="ghost" />

                    <flux:tooltip.content class="max-w-[20rem] space-y-2">
                        <p>
                            Please ensure your CSV file follows these guidelines before uploading:
                        </p>

                        <p>
                            1. The first row must contain column headers matching the required format. Save your file
                            with UTF-8 encoding to avoid character issues. <a href="{{ asset('student_sample.csv') }}" download >Download Sample File</a>.
                        </p>

                        <p>
                            2. <strong>Matric Number</strong> must be unique. Duplicate matric numbers will be skipped.
                        </p>

                        <p>
                            3. <strong>Email</strong> must also be unique and valid. Duplicate or invalid emails will
                            not be imported.
                        </p>

                        <p>
                            Any row that doesn't meet these requirements will be skipped during the import.
                        </p>

                    </flux:tooltip.content>
                </flux:tooltip>
            </flux:heading>

            <div class="relative inline-block w-full md:w-auto">
                <input type="file" id="csv_upload" wire:model="csv_file" accept=".csv,.xlsx,.xls"
                    class="absolute inset-0 opacity-0 cursor-pointer z-10" />

                <flux:button variant="primary" as="span" class="w-full md:w-auto">
                    {{ __('Upload CSV File') }}
                </flux:button>
            </div>

            @error('csv_file')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror

            <flux:button type="submit" class="w-full md:w-auto">{{ __('Import') }}</flux:button>

            @if ($csv_file)
                <p class="text-sm text-center text-purple-700 mt-2">{{ $csv_file->getClientOriginalName() }}</p>
            @endif
        </form>
    </div>

    @include('includes.messages')
    <flux:separator variant="subtle" />

    <form wire:submit="createStudent" class="max-w-2xl space-y-6 my-8 px-4 md:px-0">
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

        <div class="flex flex-col md:flex-row justify-end gap-3">
            <flux:button variant="subtle" wire:navigate href="{{ route('students.index') }}" class="w-full md:w-auto">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary" class="w-full md:w-auto">
                {{ __('Create Student') }}
            </flux:button>
        </div>
    </form>
</div>
