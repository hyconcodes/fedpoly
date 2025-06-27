<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'journal_conference',
        'publication_year',
        'doi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
