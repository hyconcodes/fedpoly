<?php

namespace App\Livewire\Staffs;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Illuminate\Support\Str;

class StaffShow extends Component
{
    public $staff;
    public $academic;
    public $publications;
    public $academic_staff = false;

    public function mount($id)
    {
        $this->staff = User::find($id);
        $this->academic = $this->staff->academic;
        $this->publications = $this->staff->publications;
        $this->academic_staff = $this->staff->academic_staff;
    }

    public function downloadPDF()
    {
        $user = $this->staff;

        $education = $user->academic;
        $publications = $user->publications ?? collect();

        $data = compact('user', 'education', 'publications');

        $pdf = Pdf::loadView('pdf.cv', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, Str::slug($user->name) . '_CV.pdf');
    }

    public function render()
    {
        return view('livewire.staffs.staff-show', [
            'staff' => $this->staff,
            'academic' => $this->academic,
            'publications' => $this->publications,
            'academic_staff' => $this->academic_staff,
        ]);
    }
}
