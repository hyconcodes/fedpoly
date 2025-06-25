<?php
use Livewire\Volt\Component;
new class extends Component {
    public function openModal()
    {
        if (Auth()->user()->picture === null) {
            $this->modal('upload-picture')->show();
        } else {
            $this->modal('confirm-details')->show();
        }
    }
}; ?>

<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @include('includes.calendar')

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex items-center justify-center">

                @can('pay.idc')
                    <flux:modal.trigger>
                        <flux:button wire:click="openModal"
                            class="px-4 py-2 !bg-purple-600 !text-white rounded-lg !hover:bg-purple-700 transition-colors">
                            Request for ID Card</flux:button>
                    </flux:modal.trigger>
                @endcan

                <flux:modal name="confirm-details" class="md:w-200">
                    <div class="space-y-6">
                        <div class="">
                            <flux:heading size="lg">Your Details</flux:heading>
                            <flux:text class="mt-2">Confirm your personal information</flux:text>
                        </div>
                        <div class="flex flex-col items-center gap-4">
                            <div class="h-24 w-24 rounded-full overflow-hidden">
                                <img src="{{ auth()->user()->picture }}" alt="Profile Picture"
                                    class="h-full w-full object-cover" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                                <div class="text-center">
                                    <flux:text class="font-semibold">Name</flux:text>
                                    <flux:text>{{ auth()->user()->name }}</flux:text>
                                </div>
                                <div class="text-center">
                                    <flux:text class="font-semibold">Matric Number</flux:text>
                                    <flux:text>{{ auth()->user()->matric_no }}</flux:text>
                                </div>
                                <div class="text-center">
                                    <flux:text class="font-semibold">Email</flux:text>
                                    <flux:text>{{ auth()->user()->email }}</flux:text>
                                </div>
                                <div class="text-center">
                                    <flux:text class="font-semibold">Gender</flux:text>
                                    <flux:text>{{ auth()->user()->gender }}</flux:text>
                                </div>
                                <div class="text-center">
                                    <flux:text class="font-semibold">Department</flux:text>
                                    <flux:text>{{ auth()->user()->department->name }}</flux:text>
                                </div>
                                <div class="text-center">
                                    <flux:text class="font-semibold">Program</flux:text>
                                    <flux:text>{{ auth()->user()->program->name }}</flux:text>
                                </div>
                                <div class="text-center">
                                    <flux:text class="font-semibold">School</flux:text>
                                    <flux:text>{{ auth()->user()->school->name }}</flux:text>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <flux:spacer />
                            <flux:button variant="primary">Cancel</flux:button>
                            <flux:button type="submit" variant="primary"
                                class="px-4 py-2 !bg-purple-600 !text-white rounded-lg !hover:bg-purple-700 transition-colors">
                                Save changes</flux:button>
                        </div>
                    </div>
                </flux:modal>
                {{-- another flux modal for showing content that you must upload your picture before proceeding, with a button of cancel and proceed --}}
                <flux:modal name="upload-picture" class="md:w-100">
                    <div class="space-y-6">
                        <div class="">
                            <flux:heading size="lg">Upload Picture Required</flux:heading>
                            <flux:text class="mt-2">You must upload your picture before proceeding with ID Card
                                request</flux:text>
                            <flux:text class="mt-2">Please visit your profile page to upload your picture</flux:text>
                        </div>
                        <div class="flex gap-4">
                            <flux:spacer />
                            <flux:button variant="primary">Cancel</flux:button>
                            <flux:button type="submit" variant="primary" href="{{ route('settings.profile') }}"
                                class="px-4 py-2 !bg-purple-600 !text-white rounded-lg !hover:bg-purple-700 transition-colors">
                                Proceed to Profile</flux:button>
                        </div>
                    </div>
                </flux:modal>

            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
    </div>
</div>
