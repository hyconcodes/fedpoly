<x-layouts.app :title="__('Dashboard')">
    @not_academic()
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
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
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    @php
                        $idcards = \App\Models\IDcard::where('status', 'completed')->count();
                        $lastMonthIdcards = \App\Models\IDcard::where('status', 'completed')
                            ->where('created_at', '<=', now()->subMonth())
                            ->count();
                    @endphp
                    <div class="flex flex-col p-4 sm:p-6">
                        <span class="text-sm sm:text-base text-gray-500">Paid for ID Cards</span>
                        <span class="text-xl sm:text-2xl md:text-3xl font-bold">{{ $idcards }}</span>
                        <div class="mt-2 sm:mt-3">
                            @php
                                $percentChange =
                                    $lastMonthIdcards > 0
                                        ? round((($idcards - $lastMonthIdcards) / $lastMonthIdcards) * 100, 1)
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
                        $transcripts = \App\Models\Transcript::where('status', 'completed')->count();
                        $lastMonthTranscripts = \App\Models\Transcript::where('status', 'completed')
                            ->where('created_at', '<=', now()->subMonth())
                            ->count();
                    @endphp
                    <div class="flex flex-col p-4 sm:p-6">
                        <span class="text-sm sm:text-base text-gray-500">Paid for Transcripts</span>
                        <span class="text-xl sm:text-2xl md:text-3xl font-bold">{{ $transcripts }}</span>
                        <div class="mt-2 sm:mt-3">
                            @php
                                $percentChange =
                                    $lastMonthTranscripts > 0
                                        ? round(
                                            (($transcripts - $lastMonthTranscripts) / $lastMonthTranscripts) * 100,
                                            1,
                                        )
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

            <div class="flex gap-4">
                <div class="w-1/2 relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-semibold mb-4">Recent ID Cards Payment</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">User</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Transaction ID
                                        </th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Department</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach (\App\Models\IDcard::where('status', 'completed')->with(['user.department'])->latest()->take(5)->get() as $idcard)
                                        <tr>
                                            <td class="px-4 py-2 text-sm">{{ $idcard->user->name }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $idcard->transaction_id }}</td>
                                            <td class="px-4 py-2 text-sm">
                                                {{ $idcard->user?->department?->name ?? 'No Department' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="w-1/2 relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-semibold mb-4">Recent Transcripts Payment</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">User</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Transaction ID
                                        </th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Department</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach (\App\Models\Transcript::where('status', 'completed')->with(['user.department'])->latest()->take(5)->get() as $transcript)
                                        <tr>
                                            <td class="px-4 py-2 text-sm">{{ $transcript->user->name }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $transcript->transaction_id }}</td>
                                            <td class="px-4 py-2 text-sm">
                                                {{ $transcript->user?->department?->name ?? 'No Department' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @include('includes.calendar')
            </div>
        </div>
    @endnot_academic

    {{-- Dashboard View For Academic Staff --}}
    @academic()
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    @php
                        $publications = \App\Models\Publication::where('user_id', auth()->id())->get();
                    @endphp
                    <div class="flex flex-col p-4 sm:p-6">
                        <span class="text-sm sm:text-base text-gray-500">Total Publications</span>
                        <span class="text-xl sm:text-2xl md:text-3xl font-bold">{{ $publications->count() }}</span>
                        <div class="mt-2 sm:mt-3">
                            @php
                                $lastMonthCount = $publications->where('created_at', '<=', now()->subMonth())->count();
                                $percentChange =
                                    $lastMonthCount > 0
                                        ? round((($publications->count() - $lastMonthCount) / $lastMonthCount) * 100, 1)
                                        : 0;
                            @endphp
                            <span class="text-xs sm:text-sm {{ $percentChange >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                {{ $percentChange >= 0 ? '↑' : '↓' }} {{ abs($percentChange) }}%
                            </span>
                            <span class="text-xs sm:text-sm text-gray-500">vs last month</span>
                        </div>
                    </div>
                </div>
                {{-- second col --}}
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    @php
                        $user = auth()->user();
                        $totalFields = 9; // Adjusted for additional education fields
                        $completedFields = 0;

                        // Check basic profile fields
                        if ($user->name) {
                            $completedFields++;
                        }
                        if ($user->email) {
                            $completedFields++;
                        }
                        if ($user->phone) {
                            $completedFields++;
                        }
                        if ($user->address) {
                            $completedFields++;
                        }
                        if ($user->department_id) {
                            $completedFields++;
                        }

                        // Check education fields
                        if ($user->education?->degree_level) {
                            $completedFields++;
                        }
                        if ($user->education?->field_of_study) {
                            $completedFields++;
                        }
                        if ($user->education?->institution) {
                            $completedFields++;
                        }
                        if ($user->education?->graduation_date) {
                            $completedFields++;
                        }

                        $completionPercentage = ($completedFields / $totalFields) * 100;
                    @endphp
                    <div class="flex flex-col p-4 sm:p-6">
                        <span class="text-sm sm:text-base lg:text-lg text-gray-500">Academic Profile Completion</span>
                        <span
                            class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">{{ round($completionPercentage) }}%</span>
                        <div class="mt-2 sm:mt-3 md:mt-4">
                            <div class="relative h-16 w-16 sm:h-20 sm:w-20 md:h-24 md:w-24 lg:h-28 lg:w-28">
                                <svg class="h-full w-full" viewBox="0 0 36 36">
                                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                        fill="none" stroke="#E5E7EB" stroke-width="3" />
                                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                        fill="none" stroke="#9333EA" stroke-width="3"
                                        stroke-dasharray="{{ $completionPercentage }}, 100" />
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span
                                        class="text-xs sm:text-sm md:text-base lg:text-lg font-semibold">{{ round($completionPercentage) }}%</span>
                                </div>
                            </div>
                            <span class="text-xs sm:text-sm md:text-base lg:text-lg text-gray-500 mt-1 sm:mt-2 block">
                                Update your profile and academic information...
                            </span>
                        </div>
                    </div>
                </div>


            </div>

            <div
                class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @include('includes.calendar')
            </div>
        </div>
    @endacademic
</x-layouts.app>
