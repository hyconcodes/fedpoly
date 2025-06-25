<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\School;
use App\Models\Inventory;

class Department extends Model
{
    protected $fillable = ['name', 'school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function students()
    {
        return $this->hasMany(User::class, 'department_id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Student');
            });
    }

    public function staffs()
    {
        return $this->hasMany(User::class, 'department_id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Staff');
            });
    }

    public function structures()
    {
        return $this->hasMany(Inventory::class, 'department_id')
            ->where('type', 'structure');
    }

    public function items()
    {
        return $this->hasMany(Inventory::class, 'department_id')
            ->where('type', 'item');
    }
}
