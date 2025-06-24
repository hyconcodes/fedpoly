<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IDcard extends Model
{
    protected $table = 'idcards';
    protected $fillable = ['user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
