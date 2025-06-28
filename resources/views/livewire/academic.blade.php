<?php
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Volt\Component;
use Illuminate\Support\Str;

new class extends Component {
    public $degree_level;
    public $field_of_study;
    public $institution;
    public $graduation_date;
    public $academic;
    public $gender;
    public $dob;
    public $objective;
    public $nationality;
    public $phone;
    public $address;

    public function mount()
    {
        $user = auth()->user();
        $this->academic = $user->academic ?? null;
        $this->gender = $user->gender;
        $this->dob = $user->dob;
        $this->objective = $user->objective;
        $this->nationality = $user->nationality;
        $this->phone = $user->phone;
        $this->address = $user->address;
        
        if ($this->academic) {
            $this->degree_level = $this->academic->degree_level;
            $this->field_of_study = $this->academic->field_of_study;
            $this->institution = $this->academic->institution;
            $this->graduation_date = $this->academic->graduation_date;
        }
    }

    public function save()
    {
        $userValidated = $this->validate([
            'gender' => 'required',
            'dob' => 'required|date',
            'objective' => 'required',
            'nationality' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $academicValidated = $this->validate([
            'degree_level' => 'required',
            'field_of_study' => 'required',
            'institution' => 'required',
            'graduation_date' => 'required|date',
        ]);

        // Update user data
        auth()->user()->update($userValidated);

        $academicValidated['user_id'] = auth()->id();

        if ($this->academic) {
            auth()->user()->academic()->update($academicValidated);
        } else {
            auth()->user()->academic()->create($academicValidated);
        }

        // $this->reset(['degree_level', 'field_of_study', 'institution', 'graduation_date']);
        $this->academic = auth()->user()->academic;
    }

    public function delete()
    {
        if ($this->academic) {
            auth()->user()->academic()->delete();
            $this->academic = null;
        }
    }

    public function downloadPDF()
    {
        $user = auth()->user();

        $education = $user->academic;
        $publications = $user->publications ?? collect();

        $data = compact('user', 'education', 'publications');

        $pdf = Pdf::loadView('pdf.cv', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, Str::slug($user->name) . '_CV.pdf');
    }
}; ?>
<div>
    <div class="relative mb-6 w-full">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <flux:heading size="xl" level="1">{{ __('Academic Profile') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Manage your academic profile...') }}
                </flux:subheading>
            </div>
            <flux:button wire:click="downloadPDF"
                class="!bg-purple-700 !text-white py-2 px-4 !rounded-md !hover:bg-purple-600 cursor-pointer">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ __('Download Profile') }}
                </span>
            </flux:button>
        </div>
        <flux:separator variant="subtle" />
    </div>
    @include('includes.messages')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Update your profile</h2>
            <form wire:submit="save">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <flux:select wire:model="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </flux:select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <flux:input type="date" wire:model="dob"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nationality</label>
                        <flux:input type="text" wire:model="nationality"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <flux:input type="text" wire:model="address"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                        <flux:input type="tel" wire:model="phone"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <h2 class="text-lg font-semibold mb-4">Add Academic Qualification</h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Career Objective</label>
                        <flux:textarea wire:model="objective"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="3">
                        </flux:textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Degree Level</label>
                        <flux:select wire:model="degree_level"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Select Degree Level</option>
                            <option value="BSc">BSc</option>
                            <option value="BA">BA</option>
                            <option value="MSc">MSc</option>
                            <option value="MA">MA</option>
                            <option value="PhD">PhD</option>
                            <option value="Diploma">Diploma</option>
                        </flux:select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Field of Study</label>
                        <flux:input type="text" wire:model="field_of_study"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Institution</label>
                        <flux:input type="text" wire:model="institution"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Graduation Year</label>
                        <flux:input type="date" wire:model="graduation_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    </div>

                    <flux:button type="submit"
                        class="w-full !bg-purple-700 !text-white py-2 px-4 !rounded-md !hover:bg-purple-500">
                        Save Academic & Profile Information
                    </flux:button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Academic Qualifications</h2>
            @if ($academic)
                <div class="space-y-4">
                    <div class="border p-4 rounded-md">
                        <p class="text-gray-600">Gender: {{ auth()->user()->gender }}</p>
                        <p class="text-gray-600">Date of Birth: {{ auth()->user()->dob }}</p>
                        <p class="text-gray-600">Nationality: {{ auth()->user()->nationality }}</p>
                        <p class="text-gray-600">Address: {{ auth()->user()->address }}</p>
                        <p class="text-gray-600">Phone: {{ auth()->user()->phone }}</p>
                        <p class="text-gray-600">Objective: {{ auth()->user()->objective }}</p>
                        <h3 class="font-medium mt-4">{{ $academic->degree_level }} in {{ $academic->field_of_study }}
                        </h3>
                        <p class="text-gray-600">{{ $academic->institution }}</p>
                        <p class="text-gray-500 text-sm">Graduated: {{ $academic->graduation_date }}</p>
                        <flux:button wire:click="delete"
                            wire:confirm="Are you sure you want to delete this qualification?"
                            class="mt-4 !bg-red-500 !text-white py-2 px-4 !rounded-md !hover:bg-red-600">
                            Delete Qualification
                        </flux:button>
                    </div>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>No academic qualification added yet.</p>
                    <p class="text-sm">Add your qualification using the form.</p>
                </div>
            @endif
        </div>
    </div>
</div>
