<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'type',
        'gfx',
        'width',
        'height',
        'level_requirement',
        'max_sockets',
        'itemable_type',
        'itemable_id',
    ];

    protected $with = ['itemable'];

    public function itemable()
    {
        return $this->morphTo();
    }
}
