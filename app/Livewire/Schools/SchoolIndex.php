<?php

namespace App\Livewire\Schools;

use App\Models\School;
use Livewire\Component;

class SchoolIndex extends Component
{
    public $schools = [];

    public function destroySchool($id)
    {
        $school = School::find($id);
        if (!$school) {
            session()->flash('error', 'School not found.');
            redirect(route('schools.index'));
        }
        $school->delete();
        session()->flash('success', 'Schol deleted successfully.');
        redirect(route('schools.index'));
    }

    public function render()
    {
        $this->schools = School::orderBy('created_at', 'desc')->get();
        return view('livewire.schools.school-index');
    }
}
