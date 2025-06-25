<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    public string $name = '';
    public string $email = '';

    use WithFileUploads;
    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public $photo;

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle photo upload
        if (!empty($this->photo)) {
            $path = $this->photo->store('picture', 'public');
            $user->picture = '/storage/' . $path;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6" enctype="multipart/form-data">
            <div class="mb-4">
                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                        wire:model="photo"
                        x-ref="photo"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        " />

                    <div class="flex items-center gap-4">
                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ auth()->user()->picture }}" alt="{{ auth()->user()->name }}" class="h-20 w-20 rounded-full object-cover">
                            {{-- <img src="{{ Storage::url(auth()->user()->picture) }}" alt="{{ auth()->user()->name }}" class="h-20 w-20 rounded-full object-cover"> --}}
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <img :src="photoPreview" class="h-20 w-20 rounded-full object-cover">
                        </div>

                        <flux:button type="button" class="mt-2" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </flux:button>
                    </div>
                </div>
            </div>
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" disabled />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" readonly disabled />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            @if(auth()->user()->hasRole('Student'))
            <div class="space-y-4">
                <div>
                    <flux:text class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Matric Number') }}</flux:text>
                    <flux:text class="block mt-1">{{ auth()->user()->matric_no }}</flux:text>
                </div>

                <div>
                    <flux:text class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Department') }}</flux:text>
                    <flux:text class="block mt-1">{{ auth()->user()->department->name }}</flux:text>
                </div>

                <div>
                    <flux:text class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('School') }}</flux:text>
                    <flux:text class="block mt-1">{{ auth()->user()->school->name }}</flux:text>
                </div>

                <div>
                    <flux:text class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Program') }}</flux:text>
                    <flux:text class="block mt-1">{{ auth()->user()->program->name }}</flux:text>
                </div>
            </div>
            @endif
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
