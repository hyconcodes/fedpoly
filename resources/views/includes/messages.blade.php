<div class="" x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)">
    @if (session()->has('success'))
        <div x-show="show" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 relative" role="alert">
            <span class="font-medium">Success alert!</span> {{ session('success') }}
            <button @click="show = false" class="absolute top-2 right-2 text-green-700 hover:text-green-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif
    @if (session()->has('error'))
        <div x-show="show" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 relative" role="alert">
            <span class="font-medium">Error alert!</span> {{ session('error') }}
            <button @click="show = false" class="absolute top-2 right-2 text-red-700 hover:text-red-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif
    @if (session()->has('message'))
        <div x-show="show" class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800 relative" role="alert">
            <span class="font-medium">Info alert!</span> {{ session('message') }}
            <button @click="show = false" class="absolute top-2 right-2 text-blue-700 hover:text-blue-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif
    @error('*')
        <div x-show="show" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 relative" role="alert">
            <span class="font-medium">Error alert!</span> {{ $message }}
            <button @click="show = false" class="absolute top-2 right-2 text-red-700 hover:text-red-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @enderror
</div>