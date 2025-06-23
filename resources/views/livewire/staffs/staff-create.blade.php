<div>
    <div class="relative mb-6 w-full">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <flux:heading size="xl" class="my-4" level="1">{{ __('Create New Staff') }}</flux:heading>

            <form wire:submit.prevent="uploadStaffCsv" enctype="multipart/form-data"
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
                                1. The first row must contain column headers matching the required format. Save your
                                file
                                with UTF-8 encoding to avoid character issues. <a
                                    href="{{ asset('student_sample.csv') }}" download>Download Sample File</a>.
                            </p>

                            <p>
                                3. <strong>Email</strong> must also be unique and valid. Duplicate or invalid emails
                                will
                                not be imported.
                            </p>

                            <p>
                                4. Do not upload repeated data, if it's already exists in the system.
                            </p>

                            <p>
                                Any row that doesn't meet these requirements will be skipped during the import.
                            </p>

                        </flux:tooltip.content>
                    </flux:tooltip>
                </flux:heading>

                <div class="relative inline-block w-full md:w-auto">
                    <input type="file" id="csv_upload" wire:model="staff_csv_file" accept=".csv,.xlsx,.xls"
                        class="absolute inset-0 opacity-0 cursor-pointer z-10" required />

                    <flux:button variant="primary" as="span" class="w-full md:w-auto">
                        {{ __('Upload CSV File') }}
                    </flux:button>
                </div>

                @error('staff_csv_file')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
                {{-- hh --}}
                <flux:select wire:model.defer="role_id" id="role_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500
                     dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                    <flux:select.option value="">{{ __('Select a role') }}</flux:select.option>
                    {{-- Assuming $roles is passed from the Livewire component --}}
                    @if (isset($roles))
                        @foreach ($roles as $role)
                            <flux:select.option value="{{ $role->id }}">{{ $role->name }}</flux:select.option>
                        @endforeach
                    @endif
                </flux:select>
                @error('role_id')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
                {{-- hh --}}

                <flux:button type="submit" class="w-full md:w-auto">{{ __('Import') }}</flux:button>

                @if ($staff_csv_file)
                    <p class="text-sm text-center text-purple-700 mt-2">{{ $staff_csv_file->getClientOriginalName() }}
                    </p>
                @endif
            </form>
        </div>

        @include('includes.messages')
        <flux:separator variant="subtle" />

        <form wire:submit.prevent="createStaff" class="max-w-2xl space-y-6 my-8 px-4 md:px-0">
            <!-- Name -->
            <flux:input wire:model.defer="name" :label="__('Name')" type="text" required autofocus
                autocomplete="name" :placeholder="__('Full name')" />

            <!-- Email Address -->
            <flux:input wire:model.defer="email" :label="__('Email')" type="email" required autocomplete="email"
                :placeholder="__('e.g., staff@example.com')" />

            <!-- Role -->
            <div>
                <label for="role_id"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Role') }}</label>
                <flux:select wire:model.defer="role_id" id="role_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                    <flux:select.option value="">{{ __('Select a role') }}</flux:select.option>
                    {{-- Assuming $roles is passed from the Livewire component --}}
                    @if (isset($roles))
                        @foreach ($roles as $role)
                            <flux:select.option value="{{ $role->id }}">{{ $role->name }}</flux:select.option>
                        @endforeach
                    @endif
                </flux:select>
                @error('role_id')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <flux:input wire:model.defer="password" :label="__('Password')" type="password" required
                autocomplete="new-password" :placeholder="__('Enter a secure password')" />

            <!-- Confirm Password -->
            <flux:input wire:model.defer="password_confirmation" :label="__('Confirm Password')" type="password"
                required autocomplete="new-password" :placeholder="__('Confirm your password')" />

            <div class="flex flex-col md:flex-row justify-end gap-3 pt-4">
                <flux:button variant="subtle" wire:navigate href="{{ route('staffs.index') }}"
                    class="w-full md:w-auto">
                    {{ __('Cancel') }}
                </flux:button>
                <flux:button type="submit" variant="primary" class="w-full md:w-auto" wire:loading.attr="disabled"
                    wire:target="createStaff">
                    {{ __('Create Staff') }}
                </flux:button>
            </div>
        </form>
    </div>
</div>
