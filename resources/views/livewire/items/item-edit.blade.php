 <div class="py-6">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
             <div class="flex justify-between items-start">
                 <div>
                     <h1 class="text-2xl font-bold">{{ __('Edit Item') }}</h1>
                     <p class="text-lg text-gray-600 mb-6">{{ __('Update item details') }}</p>
                     @include('includes.messages')
                 </div>
             </div>
             <form wire:submit.prevent="updateItem">
                 <div class="grid grid-cols-1 gap-6">
                     <div>
                         <label for="name" class="block text-sm font-medium text-gray-700">Item Name</label>
                         <flux:input type="text" wire:model="name" id="name"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" />
                         @error('name')
                             <span class="text-red-500 text-sm">{{ $message }}</span>
                         @enderror
                     </div>

                     <div>
                         <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                         <flux:input type="number" wire:model="quantity" id="quantity"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" />
                         @error('quantity')
                             <span class="text-red-500 text-sm">{{ $message }}</span>
                         @enderror
                     </div>

                     <div>
                         <label for="unit" class="block text-sm font-medium text-gray-700">Unit</label>
                         <flux:input type="text" wire:model="unit" id="unit"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" />
                         @error('unit')
                             <span class="text-red-500 text-sm">{{ $message }}</span>
                         @enderror
                     </div>

                     <div>
                         <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                         <flux:input type="text" wire:model="description" id="description"
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" />
                         @error('description')
                             <span class="text-red-500 text-sm">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="flex space-x-4">
                         <a href="{{ route('items') }}"
                             class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                             Cancel
                         </a>
                         <flux:button type="submit"
                             class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md !text-white !bg-purple-600 !hover:bg-purple-700">
                             Save Changes
                         </flux:button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
