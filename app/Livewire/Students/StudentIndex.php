<?php

namespace App\Livewire\Students;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class StudentIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search = '';

    public function destroyStudent($id)
    {
        $student = User::find($id);
        if ($student) {
            $student->delete();
            session()->flash('success', __('Student deleted successfully!'));
        } else {
            session()->flash('error', __('Something went wrong!'));
        }
        return to_route('students.index');
    }
    
    public function render()
    {
        $students = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Student');
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('matric_no', 'like', '%' . $this->search . '%');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(8);
        return view('livewire.students.student-index', compact('students'));
    }
}
