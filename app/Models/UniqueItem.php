<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniqueItem extends Model
{
    protected $fillable = ['item_id', 'transform', 'rarity', 'level_required'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
