<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'user_id',
        'degree_level',
        'field_of_study',
        'institution',
        'graduation_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
