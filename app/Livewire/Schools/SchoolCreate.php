<?php

namespace App\Livewire\Schools;

use App\Models\School;
use Livewire\Component;

class SchoolCreate extends Component
{
    public $name;
    public function createSchool()
    {
        $this->validate([
            'name' => 'required|unique:schools,name'
        ]);
        $school = School::create(['name' => $this->name]);
        return to_route('schools.index')->with('message', 'school created');
    }
    public function render()
    {
        return view('livewire.schools.school-create');
    }
}
