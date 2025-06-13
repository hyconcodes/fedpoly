<?php

namespace App\Livewire\Programs;

use App\Models\Program;
use Livewire\Component;

class ProgramCreate extends Component
{
    public $name;
    public function createProgram()
    {
        $this->validate([
            'name' => 'required|unique:programs,name'
        ]);
        $program = Program::create(['name' => $this->name]);
        return to_route('programs.index')->with('message', 'programme created');
    }
    public function render()
    {
        return view('livewire.programs.program-create');
    }
}
