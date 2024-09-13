<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyStat extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'code',
        'set',
        'value',
        'stat',
        'function'
    ];
}
