<?php

namespace App\Livewire\Staffs;

use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class StaffCreate extends Component
{
    public $name, $role_id, $email, $password, $password_confirmation;
    public $role, $staff_csv_file, $department_id, $departments = [], $school_id, $schools, $academic_staff;
    use WithFileUploads;


    public function mount()
    {
        $this->schools = School::all();
    }

    public function populateDepartment($id)
    {
        $this->departments = School::find($id)->departments;
    }

    public function createStaff()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email|min:3',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|confirmed|min:6',
            'department_id' => 'required|exists:departments,id',
            'school_id' => 'required|exists:schools,id',
            'academic_staff' => 'required|in:true,false',
        ]);
        if ($this->academic_staff === 'true') {
            $isAcademic = true;
        } else {
            $isAcademic = false;
        }
        $staff = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'department_id' => $this->department_id,
            'school_id' => $this->school_id,
            'academic_staff' => $isAcademic,
        ]);
        if ($staff) {
            $this->role = Role::where('id', $this->role_id)->first();
            $staff->syncRoles($this->role);
            $staff->save();
            Password::sendResetLink(['email' => $staff->email]);
            session()->flash('success', __('Staff created successfully! A reset link has been sent to their email.'));
            return to_route('staffs.index');
        } else {
            session()->flash('error', __('Something went wrong!'));
            return to_route('staffs.create');
        }
    }

    // csv upload
    public function uploadStaffCsv()
    {
        try {
            $this->validate([
                'staff_csv_file' => 'required|file|mimes:csv,xlsx,xls,txt|max:5048',
                'role_id' => 'required|exists:roles,id',
                'department_id' => 'required|exists:departments,id',
                'school_id' => 'required|exists:schools,id',
                'academic_staff' => 'required|in:true,false',
            ]);
            $collection = Excel::toCollection(null, $this->staff_csv_file)[0];
            $header = $collection->first();
            $rows = $collection->slice(1);

            $rowCount = 0;
            $errors = [];

            foreach ($rows as $row) {
                try {
                    $rowData = $header->combine($row);
                    if (!isset($rowData['name'], $rowData['email'])) {
                        continue;
                    }
                    if ($this->academic_staff === 'true') {
                        $isAcademic = true;
                    } else {
                        $isAcademic = false;
                    }
                    $staff = User::updateOrCreate(
                        ['email' => $rowData['email']],
                        [
                            'name' => $rowData['name'],
                            'password' => Hash::make(Str::random(10)),
                            'department_id' => $this->department_id,
                            'school_id' => $this->school_id,
                            'academic_staff' => $isAcademic,
                        ]
                    );
                    if ($staff) {
                        $this->role = Role::where('id', $this->role_id)->first();
                        $staff->syncRoles($this->role);
                        $staff->save();
                        Password::sendResetLink(['email' => $staff->email]);
                    }
                    $rowCount++;
                } catch (\Exception $e) {
                    $errors[] = "Error processing row: " . $e->getMessage();
                    continue;
                }
            }

            $this->reset('staff_csv_file');

            if (!empty($errors)) {
                session()->flash('error', implode(' | ', $errors));
            }

            session()->flash('success', "{$rowCount} staffs imported successfully.");
            return to_route('staffs.index');
        } catch (\Exception $e) {
            session()->flash('error', "File upload failed: " . $e->getMessage());
            return to_route('staffs.index');
        }
    }
    public function render()
    {
        $roles = Role::whereNotIn('name', ['Student', 'Super admin'])->get();
        return view('livewire.staffs.staff-create', compact('roles'));
    }
}
