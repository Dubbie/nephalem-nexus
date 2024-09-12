<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemProperty extends Model
{
    protected $fillable = [
        'code',
        'done',
        'desc',
        'param',
        'min',
        'max',
        'notes',
        'eol',
    ];

    public function stats()
    {
        return $this->hasMany(ItemPropertyStat::class);
    }
}
