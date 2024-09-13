<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffixItemType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'item_type',
        'equipment_type'
    ];
}
