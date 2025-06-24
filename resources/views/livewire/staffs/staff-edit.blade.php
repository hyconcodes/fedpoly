<div>
    <div class="relative mb-6 w-full">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold">{{ __('Edit staff') }}</h1>
                <p class="text-lg text-gray-600 mb-6">{{ __('Update Staff details') }}</p>
                @include('includes.messages')
            </div>
        </div>

        <div class="border-t border-gray-200 my-6"></div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form wire:submit.prevent="updateStaff">
                @csrf
                {{-- staff Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Staff Name</label>
                    <flux:input type="text" wire:model.defer="name" id="name"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter staff name" />
                    @error('name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <flux:input type="email" wire:model.defer="email" id="email"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter staff email" />
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <flux:checkbox.group wire:model.defer="role_id" label="Role">
                        @if (isset($roles))
                            @foreach ($roles as $role)
                                <flux:checkbox label="{{ $role->name }}" value="{{ $role->id }}" />
                            @endforeach
                        @endif
                    </flux:checkbox.group>
                    @error('role_id')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Staff Type -->
                <div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Staff
                            Type</label>
                        <div class="flex gap-4">
                            <div class="flex items-center">
                                <input type="radio" name="academic_staff" wire:model="academic_staff" value="true"
                                    class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300"
                                    {{ $academic_staff === true ? 'checked' : '' }}>
                                <label class="ml-2 text-sm text-gray-700 dark:text-gray-300">Academic Staff</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="academic_staff" wire:model="academic_staff" value="false"
                                    class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300"
                                    {{ $academic_staff === false ? 'checked' : '' }}>
                                <label class="ml-2 text-sm text-gray-700 dark:text-gray-300">Non-Academic Staff</label>
                            </div>
                        </div>
                    </div>
                    @error('academic_staff')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                {{-- School --}}
                <div class="mb-6">
                    <label for="school" class="block text-sm font-medium text-gray-700 mb-1">School</label>
                    <flux:select wire:model.defer="school_id" wire:change="populateDepartment($event.target.value)"
                        id="school"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Select School</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </flux:select>
                    @error('school')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Department --}}
                <div class="mb-6">
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                    <flux:select wire:model.defer="department_id" id="department"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </flux:select>
                    @error('department')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <flux:input type="password" wire:model.defer="password" id="password"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter new password (optional)" />
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                        Password</label>
                    <flux:input type="password" wire:model.defer="password_confirmation" id="password_confirmation"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Confirm new password" />
                    @error('password_confirmation')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('staffs.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" wire:loading.attr="disabled" wire:target="updateStaff"
                        class="px-4 py-2 bg-purple-600 text-white font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition shadow-sm">
                        <span wire:loading.remove wire:target="updateStaff">
                            Save Changes
                        </span>
                        <span wire:loading wire:target="updateStaff">
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
