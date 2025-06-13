<?php

use App\Livewire\Departments\DepartmentCreate;
use App\Livewire\Departments\DepartmentEdit;
use App\Livewire\Departments\DepartmentIndex;
use App\Livewire\Programs\ProgramCreate;
use App\Livewire\Programs\ProgramEdit;
use App\Livewire\Programs\ProgramIndex;
use App\Livewire\Roles\RolesCreate;
use App\Livewire\Roles\RolesEdit;
use App\Livewire\Roles\RolesIndex;
use App\Livewire\Schools\SchoolCreate;
use App\Livewire\Schools\SchoolEdit;
use App\Livewire\Schools\SchoolIndex;
use App\Livewire\Students\StudentCreate;
use App\Livewire\Students\StudentEdit;
use App\Livewire\Students\StudentIndex;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    // roles routes
    Route::get('roles', RolesIndex::class)->name('roles.index');
    Route::get('roles/create', RolesCreate::class)->name('roles.create');
    Route::get('roles/edit/{id}', RolesEdit::class)->name('roles.edit');

    // school routes
    Route::get('schools', SchoolIndex::class)->name('schools.index');
    Route::get('schools/create', SchoolCreate::class)->name('schools.create');
    Route::get('schools/edit/{id}', SchoolEdit::class)->name('schools.edit');

    // programmes routes
    Route::get('programs', ProgramIndex::class)->name('programs.index');
    Route::get('programs/create', ProgramCreate::class)->name('programs.create');
    Route::get('programs/edit/{id}', ProgramEdit::class)->name('programs.edit');

    // departments routes
    Route::get('departments', DepartmentIndex::class)->name('departments.index');
    Route::get('departments/create', DepartmentCreate::class)->name('departments.create');
    Route::get('departments/edit/{id}', DepartmentEdit::class)->name('departments.edit');

    // students routes
    Route::get('students', StudentIndex::class)->name('students.index');
    Route::get('students/create', StudentCreate::class)->name('students.create');
    Route::get('students/edit/{id}', StudentEdit::class)->name('students.edit');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
