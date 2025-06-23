<?php

namespace App\Livewire\Students;

use App\Models\User;
use Livewire\Component;

class StudentShow extends Component
{
    public $student;

    public function mount($id)
    {
        $this->student = User::find($id);
    }
        
    public function render()
    {
        return view('livewire.students.student-show');
    }
}
