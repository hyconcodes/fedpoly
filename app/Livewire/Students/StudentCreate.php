<?php

namespace App\Livewire\Students;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class StudentCreate extends Component
{
    public $name, $email, $matric_no, $password, $password_confirmation;
    public $role, $csv_file;

    use WithFileUploads;

    public function createStudent()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email|min:3',
            'matric_no' => 'nullable|string|unique:users,matric_no',
            'password' => 'required|string|confirmed|min:6',
        ]);
        $student = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'matric_no' => $this->matric_no,
            'password' => Hash::make($this->password),
        ]);
        if ($student) {
            $this->role = Role::where('name', 'Student')->first();
            $student->syncRoles($this->role);
            // Send password reset email
            $student->save();
            Password::sendResetLink(['email' => $student->email]);
            session()->flash('success', __('Student created successfully! A reset link has been sent to their email.'));
            return to_route('students.index');
        } else {
            session()->flash('error', __('Something went wrong!'));
            return to_route('students.create');
        }
    }

    // for upload student csv file

    public function uploadCsv()
    {
        $this->validate([
            'csv_file' => 'required|file|mimes:csv,xlsx,xls,txt|max:5048',
        ]);
        // dd($this->csv_file);
        $collection = Excel::toCollection(null, $this->csv_file)[0];

        $header = $collection->first();
        $rows = $collection->slice(1);

        $rowCount = 0;

        foreach ($rows as $row) {
            $rowData = $header->combine($row); // Matches headers to values

            if (!isset($rowData['name'], $rowData['email'])) {
                continue; // skip invalid rows
            }
            $student = User::updateOrCreate(
                ['email' => $rowData['email']],
                [
                    'name' => $rowData['name'],
                    'matric_no' => $rowData['matric'],
                    'password' => Hash::make(str()->random(10)),
                ]
            );
            $student->syncRoles(Role::firstOrCreate(['name' => 'Student']));
            Password::sendResetLink(['email' => $student->email]);
            $rowCount++;
        }

        session()->flash('success', "{$rowCount} students imported successfully.");
        return to_route('students.index');
        $this->reset('csv_file');
    }

    public function render()
    {
        return view('livewire.students.student-create');
    }
}
