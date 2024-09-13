<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armor extends Model
{
    protected $fillable = ['item_id', 'min_ac', 'max_ac'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
