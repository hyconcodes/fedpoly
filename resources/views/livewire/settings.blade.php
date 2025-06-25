<?php

use Livewire\Volt\Component;
use App\Models\Setting;

new class extends Component {
    public $idcard_amount;
    public $transcript_amount;

    public function mount()
    {
        $setting = Setting::first();
        $this->idcard_amount = $setting?->idcard_amount ?? 0;
        $this->transcript_amount = $setting?->transcript_amount ?? 0;
    }

    public function saveSettings()
    {
        $this->validate([
            'idcard_amount' => 'required|numeric',
            'transcript_amount' => 'required|numeric',
        ]);

        $setting = Setting::first();
        if ($setting) {
            $setting->update([
                'idcard_amount' => $this->idcard_amount,
                'transcript_amount' => $this->transcript_amount,
            ]);
        } else {
            Setting::create([
                'idcard_amount' => $this->idcard_amount,
                'transcript_amount' => $this->transcript_amount,
            ]);
        }
        $this->modal('settings-updated')->show();
    }
}; ?>
<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Admin Settings') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your platform settings') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    @include('includes.messages')
    <div class="max-w-xl">
        <form wire:submit="saveSettings" class="space-y-6">
            <div>
                <flux:label for="idcard_amount">{{ __('ID Card Amount') }}</flux:label>
                <flux:input type="number" id="idcard_amount" wire:model="idcard_amount"
                    placeholder="Enter ID card amount" />
                @error('idcard_amount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <flux:label for="transcript_amount">{{ __('Transcript Amount') }}</flux:label>
                <flux:input type="number" id="transcript_amount" wire:model="transcript_amount"
                    placeholder="Enter transcript amount" />
                @error('transcript_amount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <flux:button type="submit" class="!bg-purple-600 !text-white !hover:bg-purple-700 cursor-pointer">
                    {{ __('Save Settings') }}
                </flux:button>
            </div>
        </form>
    </div>

    <flux:modal name="settings-updated" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Success!</flux:heading>
                <flux:text class="mt-2">
                    <p>Settings updated successfully.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="primary">OK</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>
