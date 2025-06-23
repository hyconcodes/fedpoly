<div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="px-0 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Create New Item</h3>
            <p class="mt-1 text-sm text-gray-600">
                Add a new item to your organization.
            </p>
        </div>
        @include('includes.messages')
        <div class="mt-5">
            <form wire:submit.prevent="saveItem">
                <div class="shadow rounded-md overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="w-full">
                            <label for="name" class="block text-sm font-medium text-gray-700">Item Name</label>
                            <div class="mt-1">
                                <flux:input type="text" wire:model="name" id="name"
                                    class="shadow-sm focus:ring-purple-500 focus:border-purple-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <div class="mt-1">
                                <flux:input type="number" wire:model="quantity" id="quantity"
                                    class="shadow-sm focus:ring-purple-500 focus:border-purple-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                @error('quantity')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="unit" class="block text-sm font-medium text-gray-700">Unit</label>
                            <div class="mt-1">
                                <flux:input type="text" wire:model="unit" id="unit"
                                    class="shadow-sm focus:ring-purple-500 focus:border-purple-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                @error('unit')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <flux:textarea wire:model="description" id="description" rows="3"
                                    class="shadow-sm focus:ring-purple-500 focus:border-purple-500 block w-full sm:text-sm border-gray-300 rounded-md"></flux:textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                            wire:loading.attr="disabled"
                            wire:target="saveItem"
                            class="w-full sm:w-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            <span wire:loading wire:target="saveItem" class="flex items-center justify-center w-full">
                                <svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                                Processing...
                            </span>
                            <span wire:loading.remove wire:target="saveItem">
                                Create Item
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
