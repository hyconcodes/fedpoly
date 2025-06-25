<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @php
                    $students = \App\Models\User::role('Student')->get();
                @endphp
                <div class="flex flex-col p-4 sm:p-6">
                    <span class="text-sm sm:text-base text-gray-500">Total Students</span>
                    <span class="text-xl sm:text-2xl md:text-3xl font-bold">{{ $students->count() }}</span>
                    <div class="mt-2 sm:mt-3">
                        @php
                            $lastMonthCount = $students->where('created_at', '<=', now()->subMonth())->count();
                            $percentChange =
                                $lastMonthCount > 0
                                    ? round((($students->count() - $lastMonthCount) / $lastMonthCount) * 100, 1)
                                    : 0;
                        @endphp
                        <span class="text-xs sm:text-sm {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                        </span>
                        <span class="text-xs sm:text-sm text-gray-500">vs last month</span>
                    </div>
                </div>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @php
                    $staff = \App\Models\User::role('Staff')->get();
                @endphp
                <div class="flex flex-col p-4 sm:p-6">
                    <span class="text-sm sm:text-base text-gray-500">Total Staff</span>
                    <span class="text-xl sm:text-2xl md:text-3xl font-bold">{{ $staff->count() }}</span>
                    <div class="mt-2 sm:mt-3">
                        @php
                            $lastMonthCount = $staff->where('created_at', '<=', now()->subMonth())->count();
                            $percentChange =
                                $lastMonthCount > 0
                                    ? round((($staff->count() - $lastMonthCount) / $lastMonthCount) * 100, 1)
                                    : 0;
                        @endphp
                        <span class="text-xs sm:text-sm {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                        </span>
                        <span class="text-xs sm:text-sm text-gray-500">vs last month</span>
                    </div>
                </div>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @php
                    $structures = \App\Models\Inventory::where('type', 'structure')->count();
                    $lastMonthStructures = \App\Models\Inventory::where('type', 'structure')
                        ->where('created_at', '<=', now()->subMonth())
                        ->count();
                @endphp
                <div class="flex flex-col p-4 sm:p-6">
                    <span class="text-sm sm:text-base text-gray-500">Total Structures</span>
                    <span class="text-xl sm:text-2xl md:text-3xl font-bold">{{ $structures }}</span>
                    <div class="mt-2 sm:mt-3">
                        @php
                            $percentChange =
                                $lastMonthStructures > 0
                                    ? round((($structures - $lastMonthStructures) / $lastMonthStructures) * 100, 1)
                                    : 0;
                        @endphp
                        <span class="text-xs sm:text-sm {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                        </span>
                        <span class="text-xs sm:text-sm text-gray-500">vs last month</span>
                    </div>
                </div>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @php
                    $items = \App\Models\Inventory::where('type', 'item')->count();
                    $lastMonthItems = \App\Models\Inventory::where('type', 'item')
                        ->where('created_at', '<=', now()->subMonth())
                        ->count();
                @endphp
                <div class="flex flex-col p-4 sm:p-6">
                    <span class="text-sm sm:text-base text-gray-500">Total Items</span>
                    <span class="text-xl sm:text-2xl md:text-3xl font-bold">{{ $items }}</span>
                    <div class="mt-2 sm:mt-3">
                        @php
                            $percentChange =
                                $lastMonthItems > 0
                                    ? round((($items - $lastMonthItems) / $lastMonthItems) * 100, 1)
                                    : 0;
                        @endphp
                        <span class="text-xs sm:text-sm {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                        </span>
                        <span class="text-xs sm:text-sm text-gray-500">vs last month</span>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            @include('includes.calendar')
        </div>
    </div>
</x-layouts.app>
