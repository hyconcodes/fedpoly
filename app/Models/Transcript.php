<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'transaction_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
