<div class="relative mb-6 w-full">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold">{{ __('Student') }}</h1>
            <p class="text-lg text-purple-600 mb-6">{{ __('Manage student') }}</p>
            @include('includes.messages')
        </div>

        <a href="{{ route('students.create') }}"
            class="px-4 py-2 bg-purple-600 text-white font-medium rounded-md hover:bg-purple-700 transition shadow-sm">
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Create Student
            </span>
        </a>
    </div>

    <div class="border-t border-purple-200 my-6"></div>

    <div class="mb-4">
        <flux:input type="text" wire:model.live.debounce.100ms="search" placeholder="Search students..."
            class="w-full sm:w-auto px-4 py-2 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500" />
    </div>
    <div class="bg-white rounded-lg shadow-sm border border-purple-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-purple-200">
                <thead>
                    <tr class="bg-purple-50">
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">
                            Avatar</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">
                            Student Name</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">
                            Email</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">
                            Matric No</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">
                            School</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">
                            Department</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-purple-600 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-purple-200">
                    @forelse($students as $student)
                        <tr class="hover:bg-purple-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <flux:avatar name="{{ $student->name }}" color="auto"
                                    color:seed="{{ $student->id }}" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-purple-900">{{ $student->name }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-purple-900">{{ $student->email }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-purple-900">{{ $student->matric_no ?? 'No matric no yet' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-purple-900">{{ $student->school->name ?? 'No school assigned' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-purple-900">{{ $student->department->name ?? 'No department assigned' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('students.show', $student->id) }}"
                                        class="text-blue-600 hover:text-blue-900 p-1.5 rounded hover:bg-blue-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a> <a href="{{ route('students.edit', $student->id) }}"
                                        class="text-purple-600 hover:text-purple-900 p-1.5 rounded hover:bg-purple-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <button wire:click="destroyStudent({{ $student->id }})"
                                        wire:confirm="Are you sure you want to delete this student?"
                                        wire:loading.attr="disabled"
                                        class="text-red-600 hover:text-red-900 p-1.5 rounded hover:bg-red-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                                    <p>No students found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $students->links() }}
    </div>
</div>
