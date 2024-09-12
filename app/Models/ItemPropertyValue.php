<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPropertyValue extends Model
{
    protected $fillable = ['item_id', 'item_property_stat_id', 'value'];

    // Relationship back to the item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relationship to the ItemPropertyStat, which stores the property details
    public function propertyStat()
    {
        return $this->belongsTo(ItemPropertyStat::class, 'item_property_stat_id');
    }
}
