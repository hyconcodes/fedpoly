<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;
// dmgj yqmw plnk jkav
class User extends Authenticatable // implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'picture',
        'password',
        'matric_no',
        'academic_staff',
        'school_id',
        'program_id',
        'department_id',
        'gender',
        'phone',
        'address',
        'year_of_entry',
        'avatar',
        'dob',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'father_phone',
        'mother_phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // /** add the relationships here
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // protected static function booted()
    // {
    //     // Use the Auth facade to safely access the authenticated user
    //     $user = \Illuminate\Support\Facades\Auth::user();
    //     if ($user && !$user->hasRole('Super admin')) {
    //         static::addGlobalScope('excludeAdmin', function (Builder $builder) {
    //             $builder->whereDoesntHave('roles', function ($query) {
    //                 $query->where('name', 'Super admin');
    //             });
    //         });
    //     }
    // }
}
