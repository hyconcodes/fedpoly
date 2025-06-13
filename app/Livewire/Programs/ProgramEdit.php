<?php

namespace App\Livewire\Programs;

use Livewire\Component;
use App\Models\Program;

class ProgramEdit extends Component
{
    public $name;
    public $program;

    public function mount($id)
    {
        $this->program = Program::find($id);
        $this->name = $this->program->name;
    }

    public function updateProgram()
    {
        $this->validate(['name' => 'required|unique:programs,name']);
        $this->program->update(['name' => $this->name]);
        return to_route('programs.index')->with('success', 'program updated');
    }

    public function render()
    {
        return view('livewire.programs.program-edit');
    }
}
