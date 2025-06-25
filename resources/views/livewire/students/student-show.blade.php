<div class="">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-4">
            <a href="{{ route('students.index') }}"
                class="inline-flex items-center px-4 py-2 bg-purple-800 text-white rounded hover:bg-purple-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Students
            </a>
        </div>
        <div class="flex items-center mb-6">
            <div class="w-24 h-24 bg-purple-200 rounded-full mr-4">
                <!-- Student photo placeholder -->

                @if (!$student->picture)
                    <flux:avatar size="xl" class="w-full h-full rounded-full object-cover"
                        name="{{ $student->name }}" color="auto" color:seed="{{ $student->id }}" />
                @else
                    <img src="{{ asset($student->picture) }}" alt="{{ $student->name }}"
                        class="w-full h-full rounded-full object-cover">
                @endif
            </div>
            <div>
                <h1 class="text-2xl font-bold">{{ $student->name ?? 'No name yet' }}</h1>
                <p class="text-purple-600">Student ID/Matric: {{ $student->matric_no ?? 'No matric no yet' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="border-b pb-2">
                    <h2 class="text-lg font-semibold">Personal Information</h2>
                    <p><span class="font-medium">Date of Birth:</span> {{ $student->dob ?? 'No date of birth yet' }}</p>
                    <p><span class="font-medium">Gender:</span> {{ $student->gender ?? 'No gender yet' }}</p>
                    <p><span class="font-medium">Email:</span> {{ $student->email ?? 'No email yet' }}</p>
                    <p><span class="font-medium">Phone:</span> {{ $student->phone ?? 'No phone yet' }}</p>
                </div>

                <div class="border-b pb-2">
                    <h2 class="text-lg font-semibold">Academic Information</h2>
                    <p><span class="font-medium">Department:</span>
                        {{ $student->department->name ?? 'No department yet' }}</p>
                    <p><span class="font-medium">School:</span> {{ $student->school->name ?? 'No school yet' }}</p>
                    <p><span class="font-medium">Program:</span> {{ $student->program->name ?? 'No program yet' }}</p>
                    <p><span class="font-medium">Admission Date:</span>
                        {{ $student->year_of_entry ?? 'No admission date yet' }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="border-b pb-2">
                    <h2 class="text-lg font-semibold">Parent/Guardian Information</h2>
                    <p><span class="font-medium">Father Name:</span>
                        {{ $student->father_name ?? 'No father name yet' }}</p>
                    <p><span class="font-medium">Father Phone:</span> {{ $student->father_phone ?? 'No contact yet' }}
                    </p>
                    <p><span class="font-medium">Mother Name:</span>
                        {{ $student->mother_name ?? 'No mother name yet' }}</p>
                    <p><span class="font-medium">Mother Phone:</span> {{ $student->mother_phone ?? 'No contact yet' }}
                    </p>
                </div>

                <div class="border-b pb-2">
                    <h2 class="text-lg font-semibold">Address</h2>
                    <p>{{ $student->address ?? 'No address yet' }}</p>
                    {{-- <p>New York, NY 10001</p> --}}
                </div>
            </div>
        </div>

        <div class="mt-6 hidden">
            <h2 class="text-lg font-semibold mb-4">Academic Performance</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Subject</th>
                            <th class="px-4 py-2 border">Grade</th>
                            <th class="px-4 py-2 border">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="px-4 py-2 border">Mathematics</td>
                            <td class="px-4 py-2 border">A</td>
                            <td class="px-4 py-2 border">Excellent performance</td>
                        </tr>

                        <tr>
                            <td class="px-4 py-2 border">Science</td>
                            <td class="px-4 py-2 border">B+</td>
                            <td class="px-4 py-2 border">Very good understanding</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">English</td>
                            <td class="px-4 py-2 border">A-</td>
                            <td class="px-4 py-2 border">Strong communication skills</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
