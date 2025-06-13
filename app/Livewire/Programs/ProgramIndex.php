<?php

namespace App\Livewire\Programs;

use Livewire\Component;
use App\Models\Program;

class ProgramIndex extends Component
{
    public $programs = [];

    public function destroyProgram($id)
    {
        $program = Program::find($id);
        if (!$program) {
            session()->flash('error', 'Program not found.');
            redirect(route('programs.index'));
        }
        $program->delete();
        session()->flash('success', 'Program deleted successfully.');
        redirect(route('programs.index'));
    }

    public function render()
    {
        $this->programs = Program::orderBy('created_at', 'desc')->get();
        return view('livewire.programs.program-index');
    }
}
