<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Department Overview') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Monitor and track department statistics and metrics') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    @include('includes.messages')
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Total Students</span>
                    <span class="text-2xl font-bold">{{ $students->count() }}</span>
                    <div class="mt-2">
                        @php
                            $lastMonthCount = $students->where('created_at', '<=', now()->subMonth())->count();
                            $percentChange =
                                $lastMonthCount > 0
                                    ? round((($students->count() - $lastMonthCount) / $lastMonthCount) * 100, 1)
                                    : 0;
                        @endphp
                        <span class="text-xs {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                        </span>
                        <span class="text-xs text-gray-500">vs last month</span>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Total Staff</span>
                    <span class="text-2xl font-bold">{{ $staffs->count() }}</span>
                    <div class="mt-2">
                        @php
                            $lastMonthCount = $staffs->where('created_at', '<=', now()->subMonth())->count();
                            $percentChange =
                                $lastMonthCount > 0
                                    ? round((($staffs->count() - $lastMonthCount) / $lastMonthCount) * 100, 1)
                                    : 0;
                        @endphp
                        <span class="text-xs {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                        </span>
                        <span class="text-xs text-gray-500">vs last month</span>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Total Structures</span>
                    <span class="text-2xl font-bold">{{ $structures->count() }}</span>
                    <div class="mt-2">
                        @php
                            $lastMonthCount = $structures->where('created_at', '<=', now()->subMonth())->count();
                            $percentChange =
                                $lastMonthCount > 0
                                    ? round((($structures->count() - $lastMonthCount) / $lastMonthCount) * 100, 1)
                                    : 0;
                        @endphp
                        <span class="text-xs {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                        </span>
                        <span class="text-xs text-gray-500">vs last month</span>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Total Items</span>
                    <span class="text-2xl font-bold">{{ $items->count() }}</span>
                    <div class="mt-2">
                        @php
                            $lastMonthCount = $items->where('created_at', '<=', now()->subMonth())->count();
                            $percentChange =
                                $lastMonthCount > 0
                                    ? round((($items->count() - $lastMonthCount) / $lastMonthCount) * 100, 1)
                                    : 0;
                        @endphp
                        <span class="text-xs {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                        </span>
                        <span class="text-xs text-gray-500">vs last month</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Students Table --}}
        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Students List</h2>
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="studentSearch"
                            placeholder="Search students..."
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                    <thead class="bg-neutral-50 dark:bg-neutral-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Matric No</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Join Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-neutral-900 divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse ($students as $student)
                            <tr class="cursor-pointer hover:bg-purple-50 dark:hover:bg-neutral-800"
                                onclick="window.location='{{ route('students.show', $student->id) }}'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
                                        <flux:avatar name="{{ $student->name }}" color="auto"
                                            color:seed="{{ $student->id }}" />
                                        {{ $student->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $student->matric_no }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $student->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $student->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No students found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $students->links() }}
            </div>
        </div>

        {{-- Staff Table --}}
        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-4">
            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Staff List</h2>
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="staffSearch" placeholder="Search staff..."
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                    <thead class="bg-neutral-50 dark:bg-neutral-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Staff Type</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Join Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-neutral-900 divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse ($staffs as $staff)
                            <tr class="cursor-pointer hover:bg-purple-50 dark:hover:bg-neutral-800"
                                onclick="window.location='{{ route('staffs.index') }}'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
                                        <flux:avatar name="{{ $staff->name }}" color="auto"
                                            color:seed="{{ $staff->id }}" />
                                        {{ $staff->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $staff->email }}</td>
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $staff->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No staff found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $staffs->links() }}
            </div>
        </div>
        {{-- Structures Table --}}
        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-4">
            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Structures/Building List</h2>
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="structureSearch"
                            placeholder="Search structures..."
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                    <thead class="bg-neutral-50 dark:bg-neutral-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Location</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Created At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-neutral-900 divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse ($structures as $structure)
                            <tr class="hover:bg-purple-50 dark:hover:bg-neutral-800 cursor-pointer"
                                onclick="window.location='{{ route('structures') }}'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $structure->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $structure->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $structure->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No structures found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $structures->links() }}
            </div>
        </div>

        {{-- Items Table --}}
        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-4">
            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Items List</h2>
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="itemSearch"
                            placeholder="Search items..."
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                    <thead class="bg-neutral-50 dark:bg-neutral-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Quantity</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Unit</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Description</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">
                                Created At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-neutral-900 divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse ($items as $item)
                            <tr class="hover:bg-purple-50 dark:hover:bg-neutral-800 cursor-pointer"
                                onclick="window.location='{{ route('items') }}'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->unit }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $item->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No items found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $items->links() }}
            </div>
        </div>
