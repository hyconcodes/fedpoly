<?php

use App\Livewire\Departments\DepartmentCreate;
use App\Livewire\Departments\DepartmentEdit;
use App\Livewire\Departments\DepartmentIndex;
use App\Livewire\Items\ItemCreate;
use App\Livewire\Items\ItemEdit;
use App\Livewire\Items\ItemIndex;
use App\Livewire\Programs\ProgramCreate;
use App\Livewire\Programs\ProgramEdit;
use App\Livewire\Programs\ProgramIndex;
use App\Livewire\Roles\RolesCreate;
use App\Livewire\Roles\RolesEdit;
use App\Livewire\Roles\RolesIndex;
use App\Livewire\Schools\SchoolCreate;
use App\Livewire\Schools\SchoolEdit;
use App\Livewire\Schools\SchoolIndex;
use App\Livewire\Staffs\StaffCreate;
use App\Livewire\Staffs\StaffEdit;
use App\Livewire\Staffs\StaffIndex;
use App\Livewire\Staffs\StaffShow;
use App\Livewire\Structures\StructureCreate;
use App\Livewire\Structures\StructureEdit;
use App\Livewire\Structures\StructureIndex;
use App\Livewire\Students\StudentCreate;
use App\Livewire\Students\StudentEdit;
use App\Livewire\Students\StudentIndex;
use App\Livewire\Students\StudentShow;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;







Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Volt::route('student/dashboard', 'student-dashboard')
    ->middleware(['auth', 'verified', 'role:Student'])
    ->name('student.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    // roles routes
    Route::get('roles', RolesIndex::class)->name('roles.index')->middleware('permission:view.roles|create.roles|edit.roles|delete.roles');
    Route::get('roles/create', RolesCreate::class)->name('roles.create')->middleware('permission:create.roles');
    Route::get('roles/edit/{id}', RolesEdit::class)->name('roles.edit')->middleware('permission:edit.roles');

    // school routes
    Route::get('schools', SchoolIndex::class)->name('schools.index')->middleware('permission:view.schools|create.schools|edit.schools|delete.schools');
    Route::get('schools/create', SchoolCreate::class)->name('schools.create')->middleware('permission:create.schools');
    Route::get('schools/edit/{id}', SchoolEdit::class)->name('schools.edit')->middleware('permission:edit.schools');

    // programmes routes
    Route::get('programs', ProgramIndex::class)->name('programs.index')->middleware('permission:view.programs|create.programs|edit.programs|delete.programs');
    Route::get('programs/create', ProgramCreate::class)->name('programs.create')->middleware('permission:create.programs');
    Route::get('programs/edit/{id}', ProgramEdit::class)->name('programs.edit')->middleware('permission:edit.programs');

    // departments routes
    Route::get('departments', DepartmentIndex::class)->name('departments.index')->middleware('permission:view.departments|create.departments|edit.departments|delete.departments');
    Route::get('departments/create', DepartmentCreate::class)->name('departments.create')->middleware('permission:create.departments');
    Route::get('departments/edit/{id}', DepartmentEdit::class)->name('departments.edit')->middleware('permission:edit.departments');

    // students routes
    Route::get('students', StudentIndex::class)->name('students.index')->middleware('permission:view.students|create.students|edit.students|delete.students');
    Route::get('students/create', StudentCreate::class)->name('students.create')->middleware('permission:create.students');
    Route::get('students/edit/{id}', StudentEdit::class)->name('students.edit')->middleware('permission:edit.students');
    Route::get('students/show/{id}', StudentShow::class)->name('students.show')->middleware('permission:view.students');

    // staffs routes
    Route::get('staffs', StaffIndex::class)->name('staffs.index')->middleware('permission:view.staffs|create.staffs|edit.staffs|delete.staffs');
    Route::get('staffs/create', StaffCreate::class)->name('staffs.create')->middleware('permission:create.staffs');
    Route::get('staffs/edit/{id}', StaffEdit::class)->name('staffs.edit')->middleware('permission:edit.staffs');
    Route::get('staffs/show/{id}', StaffShow::class)->name('staffs.show')->middleware('permission:view.staffs');

    // structure routes
    Route::get('structures', StructureIndex::class)->name('structures')->middleware('permission:view.structures|create.structures|edit.structures|delete.structures');
    Route::get('structures/create', StructureCreate::class)->name('structures.create')->middleware('permission:create.structures');
    Route::get('structures/edit/{id}', StructureEdit::class)->name('structures.edit')->middleware('permission:edit.structures');
    // Route::get('structures/show/{id}', StructureEdit::class)->name('structures.show')->middleware('permission:view.structures');

    // item routes
    Route::get('items', ItemIndex::class)->name('items')->middleware('permission:view.items|create.items|edit.items|delete.items');
    Route::get('items/create', ItemCreate::class)->name('items.create')->middleware('permission:create.items');
    Route::get('items/edit/{id}', ItemEdit::class)->name('items.edit')->middleware('permission:edit.items');

    // settings routes
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
