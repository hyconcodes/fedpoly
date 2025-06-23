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
    Route::get('roles', RolesIndex::class)->name('roles.index')->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');
    Route::get('roles/create', RolesCreate::class)->name('roles.create')->middleware('permission:roles.create');
    Route::get('roles/edit/{id}', RolesEdit::class)->name('roles.edit')->middleware('permission:roles.edit');

    // school routes
    Route::get('schools', SchoolIndex::class)->name('schools.index')->middleware('permission:schools.index|schools.create|schools.edit|schools.delete');
    Route::get('schools/create', SchoolCreate::class)->name('schools.create')->middleware('permission:schools.create');
    Route::get('schools/edit/{id}', SchoolEdit::class)->name('schools.edit')->middleware('permission:schools.edit');

    // programmes routes
    Route::get('programs', ProgramIndex::class)->name('programs.index')->middleware('permission:programs.index|programs.create|programs.edit|programs.delete');
    Route::get('programs/create', ProgramCreate::class)->name('programs.create')->middleware('permission:programs.create');
    Route::get('programs/edit/{id}', ProgramEdit::class)->name('programs.edit')->middleware('permission:programs.edit');

    // departments routes
    Route::get('departments', DepartmentIndex::class)->name('departments.index')->middleware('permission:departments.index|departments.create|departments.edit|departments.delete');
    Route::get('departments/create', DepartmentCreate::class)->name('departments.create')->middleware('permission:departments.create');
    Route::get('departments/edit/{id}', DepartmentEdit::class)->name('departments.edit')->middleware('permission:departments.edit');

    // students routes
    Route::get('students', StudentIndex::class)->name('students.index')->middleware('permission:students.index|students.create|students.edit|students.delete');
    Route::get('students/create', StudentCreate::class)->name('students.create')->middleware('permission:students.create');
    Route::get('students/edit/{id}', StudentEdit::class)->name('students.edit')->middleware('permission:students.edit');
    Route::get('students/show/{id}', StudentShow::class)->name('students.show')->middleware('permission:students.show');

    // staffs routes
    Route::get('staffs', StaffIndex::class)->name('staffs.index')->middleware('permission:staffs.index|staffs.create|staffs.edit|staffs.delete');
    Route::get('staffs/create', StaffCreate::class)->name('staffs.create')->middleware('permission:staffs.create');
    Route::get('staffs/edit/{id}', StaffEdit::class)->name('staffs.edit')->middleware('permission:staffs.edit');
    Route::get('staffs/show/{id}', StaffShow::class)->name('staffs.show')->middleware('permission:staffs.show');

    // structure routes
    Route::get('structures', StructureIndex::class)->name('structures')->middleware('permission:structures.index|structures.create|structures.edit|structures.delete');
    Route::get('structures/create', StructureCreate::class)->name('structures.create')->middleware('permission:structures.create');
    Route::get('structures/edit/{id}', StructureEdit::class)->name('structures.edit')->middleware('permission:structures.edit');
    // Route::get('structures/show/{id}', StructureEdit::class)->name('structures.show')->middleware('permission:structures.show');

    // item routes
    Route::get('items', ItemIndex::class)->name('items')->middleware('permission:items.index|items.create|items.edit|items.delete');
    Route::get('items/create', ItemCreate::class)->name('items.create')->middleware('permission:items.create');
    Route::get('items/edit/{id}', ItemEdit::class)->name('items.edit')->middleware('permission:items.edit');

    // settings routes
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
