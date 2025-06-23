<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected
    $fillable = ['name', 'type', 'location', 'quantity', 'unit', 'description'];

    public function scopeStructures($query)
    {
        return $query->where('type', 'structure');
    }

    public function scopeItems($query)
    {
        return $query->where('type', 'item');

    }
}