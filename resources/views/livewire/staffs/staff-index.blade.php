<div>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Staff List</h1>
            <a href="{{ route('staffs.create') }}"
                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Add New Staff
            </a>
        </div>
        @include('includes.messages')

        <div class="mb-4">
            <flux:input type="text" wire:model.loading.live.300ms="search" placeholder="Search staff..."
                class="w-full px-4 py-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-purple-200">
                    <thead class="bg-purple-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-500 uppercase tracking-wider">
                                Avatar
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-500 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-500 uppercase tracking-wider">
                                Staff type</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-500 uppercase tracking-wider">
                                School</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-500 uppercase tracking-wider">
                                Department</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-500 uppercase tracking-wider">
                                Role</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-purple-200">
                        @forelse($staffs as $staff)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <flux:avatar name="{{ $staff->name }}" color="auto"
                                        color:seed="{{ $staff->id }}" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $staff->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $staff->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($staff->academic_staff)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Academic Staff
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Non-Academic Staff
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $staff->school->name ?? 'No School assign yet' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $staff->department->name ?? 'No Department assign yet' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @foreach ($staff->getRoleNames() as $role)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mr-1">
                                            {{ $role }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('staffs.edit', $staff) }}"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <button wire:confirm="Are you sure you want to delete this staff?"
                                            wire:click="deleteStaff({{ $staff->id }})"
                                            class="text-red-600 hover:text-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-purple-500 bg-purple-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-400 mb-3"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p>No staff found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $staffs->links() }}
        </div>
    </div>
</div>
