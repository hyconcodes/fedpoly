<div>
    <div class="relative mb-6 w-full">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <flux:heading size="xl" level="1">{{ __('Profile') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Staff Profile and Academic Information') }}
                </flux:subheading>
                <flux:separator variant="subtle" />
            </div>

            @if ($academic_staff)
                <flux:button wire:click="downloadPDF"
                    class="!bg-purple-700 !text-white py-2 px-4 !rounded-md !hover:bg-purple-600 cursor-pointer">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        {{ __('Download Profile') }}
                    </span>
                </flux:button>
            @endif
        </div>
    </div>
    @include('includes.messages')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Staff Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="font-semibold mb-2">Personal Details</h3>
                <p><span class="font-medium">Name:</span> {{ $staff->name ?? 'N/A' }}</p>
                <p><span class="font-medium">Email:</span> {{ $staff->email ?? 'N/A' }}</p>
                <div class="flex gap-2">
                    <span class="font-medium">Roles:</span>
                    @forelse ($staff->roles as $role)
                        <span
                            class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">{{ $role->name }}</span>
                    @empty
                        <span class="text-gray-500">No roles assigned</span>
                    @endforelse
                </div>
                <p><span class="font-medium">School:</span> {{ $staff->school->name ?? 'N/A' }}</p>
                <p><span class="font-medium">Department:</span> {{ $staff->department->name ?? 'N/A' }}</p>
                <p><span class="font-medium">Gender:</span> {{ $staff->gender ?? 'N/A' }}</p>
                <p><span class="font-medium">Date of Birth:</span> {{ $staff->dob ?? 'N/A' }}</p>
                <p><span class="font-medium">Objective:</span> {{ $staff->objective ?? 'N/A' }}</p>
                <p><span class="font-medium">Nationality:</span> {{ $staff->nationality ?? 'N/A' }}</p>
                <p><span class="font-medium">Phone:</span> {{ $staff->phone ?? 'N/A' }}</p>
                <p><span class="font-medium">Address:</span> {{ $staff->address ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Academic Information</h3>
                <p><span class="font-medium">Degree Level:</span> {{ $academic->degree_level ?? 'N/A' }}</p>
                <p><span class="font-medium">Field of Study:</span> {{ $academic->field_of_study ?? 'N/A' }}</p>
                <p><span class="font-medium">Institution:</span> {{ $academic->institution ?? 'N/A' }}</p>
                <p><span class="font-medium">Graduation Date:</span> {{ $academic->graduation_date ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold mb-2">Publications</h3>
            <div class="space-y-4">
                @forelse ($publications as $publication)
                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="font-medium">{{ $publication->title ?? 'Untitled' }}</p>
                        <p class="text-sm text-gray-600">{{ $publication->journal_conference ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-500">Published: {{ $publication->publication_year ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-500">DOI: {{ $publication->doi ?? 'N/A' }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No publications found</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
