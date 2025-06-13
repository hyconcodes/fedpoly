<?php

namespace App\Livewire\Schools;

use App\Models\School;
use Livewire\Component;

class SchoolEdit extends Component
{
    public $name;
    public $school;

    public function mount($id)
    {
        $this->school = School::find($id);
        $this->name = $this->school->name;
    }

    public function updateSchool()
    {
        $this->validate(['name' => 'required|unique:schools,name']);
        $this->school->update(['name' => $this->name]);
        return to_route('schools.index')->with('success', 'school updated');
    }

    public function render()
    {
        return view('livewire.schools.school-edit');
    }
}
