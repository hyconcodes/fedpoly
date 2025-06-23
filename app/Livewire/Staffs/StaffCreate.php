<?php

namespace App\Livewire\Staffs;

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
    public $role, $staff_csv_file;
    use WithFileUploads;

    public function createStaff()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email|min:3',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|confirmed|min:6',
        ]);
        // dd([
        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'password' => Hash::make($this->password),
        //     'role_id' => $this->role_id,
        //     'csv_file' => $this->csv_file,
        // ]);
        $staff = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
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

                    $staff = User::updateOrCreate(
                        ['email' => $rowData['email']],
                        [
                            'name' => $rowData['name'],
                            'password' => Hash::make(Str::random(10)),
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
