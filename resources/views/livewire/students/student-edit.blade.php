<div>
    <div class="relative mb-6 w-full">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold">{{ __('Edit Student') }}</h1>
                <p class="text-lg text-gray-600 mb-6">{{ __('Update student details') }}</p>
                @include('includes.messages')
            </div>
        </div>

        <div class="border-t border-gray-200 my-6"></div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form wire:submit.prevent="updateStudent">
                @csrf
                {{-- Student Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Student Name</label>
                    <flux:input type="text" wire:model.defer="name" id="name"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter student name" />
                    @error('name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <flux:input type="email" wire:model.defer="email" id="email"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter student email" />
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Matric No --}}
                <div class="mb-6">
                    <label for="matric_no" class="block text-sm font-medium text-gray-700 mb-1">Matric No</label>
                    <flux:input type="text" wire:model.defer="matric_no" id="matric_no"
                        class="w-full px-3 border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter matriculation number (optional)" />
                    @error('matric_no')
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
                    <a href="{{ route('students.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" wire:loading.attr="disabled" wire:target="updateStudent"
                        class="px-4 py-2 bg-purple-600 text-white font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition shadow-sm">
                        <span wire:loading.remove wire:target="updateStudent">
                            Save Changes
                        </span>
                        <span wire:loading wire:target="updateStudent">
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
