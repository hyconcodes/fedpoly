<?php
use App\Models\Transcript;
use Livewire\WithPagination;
use Livewire\Volt\Component;

new class extends Component {
    use WithPagination;

    public $search = '';

    public function with(): array
    {
        return [
            'transcriptspayment' => Transcript::where('status', 'completed')
                ->with(['user', 'user.department'])
                ->whereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10),
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}; ?>

<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Transcript') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('View student transcripts payment status') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    @include('includes.messages')

    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by student name..."
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student
                        Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Transaction ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment
                        Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Department
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($transcriptspayment as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center">
                            @if ($payment->user->picture)
                                <img src="{{ $payment->user->picture }}" alt="{{ $payment->user->name }}"
                                    class="h-8 w-8 rounded-full mr-3">
                            @else
                                <flux:avatar name="{{ $payment->user->name }}" color="auto" class="mr-3" />
                            @endif
                            {{ $payment->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $payment->transaction_id ?? 'loading...' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $payment->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $payment->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $payment->user?->department?->name ?? 'No Department' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $transcriptspayment->links() }}
        </div>
    </div>
</div>
