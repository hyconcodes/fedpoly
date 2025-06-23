<?php

use function Livewire\Volt\{state};

state([
    'namee' => 'John Doe',
]);
?>

<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div x-data="calendar()" x-init="init()"
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-900">
            <div class="flex items-center justify-between mb-4">
                <flux:button @click="prevMonth" class="text-sm text-purple-600 hover:underline">
                    ‹ Prev
                </flux:button>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100" x-text="monthYear"></h2>
                <flux:button @click="nextMonth" class="text-sm text-purple-600 hover:underline">
                    Next ›
                </flux:button>
            </div>

            <!-- Days of Week -->
            <div class="grid grid-cols-7 text-center text-sm font-medium text-gray-500 dark:text-gray-300">
                <template x-for="day in ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']" :key="day">
                    <div x-text="day" class="py-1"></div>
                </template>
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 text-center text-sm">
                <template x-for="blank in blanks" :key="'b' + blank">
                    <div class="py-2"></div>
                </template>

                <template x-for="(date, index) in daysInMonth" :key="index">
                    <div class="py-2 rounded cursor-pointer"
                        :class="{
                            'bg-purple-600 text-white font-semibold': isToday(date),
                            'hover:bg-purple-100 dark:hover:bg-purple-800': !isToday(date)
                        }"
                        x-text="date"></div>
                </template>
            </div>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex items-center justify-center">
                <button @click="$dispatch('open-modal', 'confirm-details')"
                    class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    Request for ID Card
                </button>

                <flux:modal name="confirm-details">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold mb-4">Confirm Your Details</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm text-gray-600 dark:text-gray-400">Name</label>
                                <p class="font-medium">{{ auth()->user()->name }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600 dark:text-gray-400">Email</label>
                                <p class="font-medium">{{ auth()->user()->email }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600 dark:text-gray-400">Student ID</label>
                                <p class="font-medium">{{ auth()->user()->student_id }}</p>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button @click="$dispatch('close')"
                                class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Confirm
                                Request</button>
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
<script>
    function calendar() {
        return {
            date: new Date(),
            month: 0,
            year: 0,
            daysInMonth: [],
            blanks: [],

            init() {
                this.month = this.date.getMonth();
                this.year = this.date.getFullYear();
                this.updateCalendar();
            },

            get monthYear() {
                return new Date(this.year, this.month).toLocaleString('default', {
                    month: 'long',
                    year: 'numeric'
                });
            },

            updateCalendar() {
                const start = new Date(this.year, this.month, 1).getDay();
                const totalDays = new Date(this.year, this.month + 1, 0).getDate();

                this.blanks = Array(start).fill(null);
                this.daysInMonth = Array.from({
                    length: totalDays
                }, (_, i) => i + 1);
            },

            nextMonth() {
                if (this.month === 11) {
                    this.month = 0;
                    this.year++;
                } else {
                    this.month++;
                }
                this.updateCalendar();
            },

            prevMonth() {
                if (this.month === 0) {
                    this.month = 11;
                    this.year--;
                } else {
                    this.month--;
                }
                this.updateCalendar();
            },

            isToday(day) {
                const today = new Date();
                return day === today.getDate() &&
                    this.month === today.getMonth() &&
                    this.year === today.getFullYear();
            }
        }
    }
</script>
