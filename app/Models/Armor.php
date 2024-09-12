<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armor extends Model
{
    protected $fillable = ['item_id', 'defense', 'required_strength', 'durability', 'max_durability'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
