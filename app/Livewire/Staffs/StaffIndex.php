<?php

namespace App\Livewire\Staffs;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class StaffIndex extends Component
{
    public function rendering(View $view): void
    {
        $view->title('Staffs');
    }
    use WithPagination, WithoutUrlPagination;
    public $search = '';
    public function deleteStaff($id)
    {
        $staffs = User::find($id);
        if ($staffs) {
            $staffs->delete();
            session()->flash('success', __('Staff deleted successfully!'));
        } else {
            session()->flash('error', __('Something went wrong!'));
        }
        return to_route('staffs.index');
    }
    public function render()
    {
        $staffs = User::query()
            ->whereHas('roles', function ($query) {
                $query->whereNotIn('name', ['Super admin', 'Student']);
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhereHas('roles', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(8);
        return view('livewire.staffs.staff-index', compact('staffs'));
    }
}
