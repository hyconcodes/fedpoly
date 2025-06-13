<div>
    <div class="flex flex-col gap-4 py-6 sm:flex-row sm:items-center sm:justify-between">
        <flux:heading level="1" size="xl" class="my-4">
            {{ __('Departments List') }}
        </flux:heading>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
            {{-- Search Input --}}
            <flux:input wire:model.live.debounce.300ms="search" type="search" :placeholder="__('Search departments...')"
                class="w-full sm:w-auto" />

            <flux:button wire:navigate href="{{ route('departments.create') }}" class="bg-purple-600 hover:bg-purple-700"
                variant="primary" icon="plus">{{ __('Add New Department') }}</flux:button>
        </div>
    </div>

    @include('includes.messages')

    <flux:separator variant="subtle" class="my-6" />

    <div class="mt-6">
        {{-- Check if the $departments variable is set and not empty --}}
        @if (isset($departments) && $departments->isNotEmpty())
            <div class="overflow-x-auto rounded-lg border border-secondary-200 dark:border-secondary-700 shadow-sm">
                <table class="min-w-full divide-y divide-secondary-200 dark:divide-secondary-700">
                    <thead class="bg-secondary-50 dark:bg-secondary-800">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-secondary-500 dark:text-secondary-400">
                                {{ __('Name') }}</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-secondary-500 dark:text-secondary-400">
                                {{ __('Schools') }}</th>
                            <th scope="col"
                                class="relative px-6 py-3 text-xs uppercase tracking-wider text-right font-medium text-secondary-500 dark:text-secondary-400">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-secondary-200 bg-white dark:divide-secondary-700 dark:bg-secondary-900">
                        @foreach ($departments as $department)
                            <tr wire:key="department-{{ $department->id }}"
                                class="hover:bg-secondary-50 dark:hover:bg-secondary-800/50 transition-colors duration-150">
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-secondary-900 dark:text-white">
                                    {{ $department->name }}</td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-secondary-600 dark:text-secondary-300">
                                    {{ $department->school->name ?? 'N/A' }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-x-2">
                                        <flux:button size="sm" variant="subtle" primary icon="pencil"
                                            wire:navigate href="{{ route('departments.edit', $department) }}"
                                            :tooltip="__('Edit Department')" />
                                        <flux:button size="sm" variant="subtle" negative icon="trash"
                                            wire:click="deleteDepartment({{ $department->id }})"
                                            wire:confirm="Are you sure you want to delete this department? This action cannot be undone"
                                            :tooltip="__('Delete Department')" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination links --}}
            @if ($departments->hasPages())
                <div class="mt-6">
                    {{ $departments->links() }}
                </div>
            @endif
        @else
            {{-- Empty state: when no departments are found --}}
            <div
                class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-secondary-300 dark:border-secondary-600 p-12 text-center">
                <flux:icon name="academic-cap" class="h-12 w-12 text-secondary-400 dark:text-secondary-500" outline />
                <h3 class="mt-2 text-sm font-semibold text-secondary-900 dark:text-white">
                    {{ __('No Departments Found') }}</h3>
                <p class="mt-1 text-sm text-secondary-500 dark:text-secondary-400">
                    {{ __('Get started by adding a new department to the list.') }}</p>
                <div class="mt-6">
                    <flux:button wire:navigate href="{{ route('departments.create') }}" variant="primary"
                        class="bg-purple-600 hover:bg-purple-700" icon="plus" :label="__('Add New Department')" />
                </div>
            </div>
        @endif
    </div>
</div>
