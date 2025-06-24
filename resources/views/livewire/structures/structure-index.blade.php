<div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Structure Inventory</h2>
            <a href="{{ route('structures.create') }}"
                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Add New Structure
            </a>
        </div>
        {{-- Search Bar --}}
        <div class="mb-4">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search structures..."
                class="w-full sm:w-1/3 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500"
            />
        </div>
        @include('includes.messages')
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Department</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($structures as $structure)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $structure->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $structure->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $structure->department->name ?? 'No Department yet' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('structures.edit', $structure) }}"
                                            class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <flux:icon.pencil-square/>
                                        </a>
                                        <button wire:confirm="Are you sure you want to delete this?"
                                            wire:click="deleteStructure({{ $structure->id }})"
                                            class="text-red-600 hover:text-red-900" title="Delete">
                                            <flux:icon.trash/>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <flux:icon.information-circle class="w-8 h-8 mb-2 text-gray-400"/>
                                        No structures found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $structures->links() }}
            </div>
        </div>
    </div>
</div>
