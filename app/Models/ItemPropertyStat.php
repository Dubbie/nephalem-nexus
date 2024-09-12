<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPropertyStat extends Model
{
    protected $fillable = [
        'item_property_id',
        'set',
        'val',
        'func',
        'stat',
    ];

    public function itemProperty()
    {
        return $this->belongsTo(ItemProperty::class);
    }

    // This stat can belong to multiple ItemPropertyValues (i.e., for different items)
    public function propertyValues()
    {
        return $this->hasMany(ItemPropertyValue::class);
    }
}
